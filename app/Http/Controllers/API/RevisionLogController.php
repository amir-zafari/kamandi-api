<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Venturecraft\Revisionable\Revision;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class RevisionLogController extends Controller
{
    /**
     * Get all revision logs | دریافت همه لاگ‌های تغییرات
     * 
     * Retrieve all revision logs with advanced filtering and pagination options.
     * 
     * @authenticated
     * @group Revision Logs
     * 
     * @queryParam user_id integer Filter by user ID. Example: 1
     * @queryParam ip_address string Filter by IP address. Example: 192.168.1.1
     * @queryParam date string Filter by specific date (Y-m-d). Example: 2024-01-15
     * @queryParam from_date string Filter from date (Y-m-d). Example: 2024-01-01
     * @queryParam to_date string Filter to date (Y-m-d). Example: 2024-01-31
     * @queryParam model_type string Filter by model type. Example: App\\Models\\User
     * @queryParam model_id integer Filter by model ID. Example: 5
     * @queryParam field string Filter by changed field name. Example: email
     * @queryParam sort_by string Sort field (default: created_at). Example: created_at
     * @queryParam sort_order string Sort order (asc/desc, default: desc). Example: desc
     * @queryParam per_page integer Items per page (default: 20). Example: 50
     * 
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "current_page": 1,
     *     "data": [
     *       {
     *         "id": 1,
     *         "user": {
     *           "id": 1,
     *           "name": "احمد محمدی",
     *           "email": "ahmad@example.com"
     *         },
     *         "model": {
     *           "type": "User",
     *           "id": 5
     *         },
     *         "field": "email",
     *         "old_value": "old@example.com",
     *         "new_value": "new@example.com",
     *         "created_at": "2024-01-15 10:30:00",
     *         "created_at_human": "2 hours ago"
     *       }
     *     ],
     *     "total": 100
     *   },
     *   "message": "لاگ‌ها با موفقیت دریافت شد"
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $query = Revision::with(['userResponsible']);

        // فیلتر بر اساس کاربر
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // فیلتر بر اساس IP (نیاز به اضافه کردن ستون ip_address به جدول revisions)
        if ($request->has('ip_address')) {
            $query->where('ip_address', $request->ip_address);
        }

        // فیلتر بر اساس تاریخ
        if ($request->has('date')) {
            $date = Carbon::parse($request->date);
            $query->whereDate('created_at', $date);
        }

        // فیلتر بر اساس بازه زمانی
        if ($request->has('from_date')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->from_date));
        }

        if ($request->has('to_date')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->to_date));
        }

        // فیلتر بر اساس نوع مدل
        if ($request->has('model_type')) {
            $query->where('revisionable_type', $request->model_type);
        }

        // فیلتر بر اساس ID مدل
        if ($request->has('model_id')) {
            $query->where('revisionable_id', $request->model_id);
        }

        // فیلتر بر اساس فیلد تغییر یافته
        if ($request->has('field')) {
            $query->where('key', $request->field);
        }

        // مرتب‌سازی
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // صفحه‌بندی
        $perPage = $request->get('per_page', 20);
        $logs = $query->paginate($perPage);

        // فرمت کردن داده‌ها
        $formattedLogs = $logs->getCollection()->map(function ($revision) {
            return $this->formatRevision($revision);
        });

        $logs->setCollection($formattedLogs);

        return response()->json([
            'success' => true,
            'data' => $logs,
            'message' => 'لاگ‌ها با موفقیت دریافت شد'
        ]);
    }

    /**
     * Get revision log statistics | دریافت آمار لاگ‌های تغییرات
     * 
     * Get comprehensive statistics about revision activities for a specific date.
     * 
     * @authenticated
     * @group Revision Logs
     * 
     * @queryParam date string Target date for statistics (Y-m-d, default: today). Example: 2024-01-15
     * 
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "date": "2024-01-15",
     *     "total_changes": 150,
     *     "active_users": 12,
     *     "changes_by_model": [
     *       {
     *         "model": "User",
     *         "count": 45
     *       },
     *       {
     *         "model": "Patient",
     *         "count": 30
     *       }
     *     ],
     *     "changes_by_user": [
     *       {
     *         "user_id": 1,
     *         "user_name": "احمد محمدی",
     *         "user_email": "ahmad@example.com",
     *         "count": 25
     *       }
     *     ],
     *     "most_changed_fields": [
     *       {
     *         "key": "email",
     *         "count": 15
     *       }
     *     ],
     *     "changes_by_hour": [
     *       {
     *         "hour": 9,
     *         "count": 10
     *       }
     *     ]
     *   },
     *   "message": "آمار با موفقیت دریافت شد"
     * }
     */
    public function statistics(Request $request): JsonResponse
    {
        $date = $request->has('date')
            ? Carbon::parse($request->date)
            : Carbon::today();

        // تعداد کل تغییرات در روز
        $totalChanges = Revision::whereDate('created_at', $date)->count();

        // تعداد کاربران فعال
        $activeUsers = Revision::whereDate('created_at', $date)
            ->distinct('user_id')
            ->count('user_id');

        // تغییرات بر اساس مدل
        $changesByModel = Revision::whereDate('created_at', $date)
            ->select('revisionable_type', DB::raw('count(*) as count'))
            ->groupBy('revisionable_type')
            ->get()
            ->map(function ($item) {
                return [
                    'model' => class_basename($item->revisionable_type),
                    'count' => $item->count
                ];
            });

        // تغییرات بر اساس کاربر
        $changesByUser = Revision::whereDate('created_at', $date)
            ->with('userResponsible:id,name,email')
            ->select('user_id', DB::raw('count(*) as count'))
            ->groupBy('user_id')
            ->orderByDesc('count')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'user_id' => $item->user_id,
                    'user_name' => $item->userResponsible?->name ?? 'سیستم',
                    'user_email' => $item->userResponsible?->email ?? null,
                    'count' => $item->count
                ];
            });

        // پرتغییرترین فیلدها
        $mostChangedFields = Revision::whereDate('created_at', $date)
            ->select('key', DB::raw('count(*) as count'))
            ->groupBy('key')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        // تغییرات بر اساس ساعت
        $changesByHour = Revision::whereDate('created_at', $date)
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('count(*) as count'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'date' => $date->format('Y-m-d'),
                'total_changes' => $totalChanges,
                'active_users' => $activeUsers,
                'changes_by_model' => $changesByModel,
                'changes_by_user' => $changesByUser,
                'most_changed_fields' => $mostChangedFields,
                'changes_by_hour' => $changesByHour,
            ],
            'message' => 'آمار با موفقیت دریافت شد'
        ]);
    }

    /**
     * Get logs of a specific user | دریافت لاگ‌های یک کاربر
     * @authenticated
     * @group Revision Logs
     */
    public function userLogs(int $userId, Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 20);

        $logs = Revision::where('user_id', $userId)
            ->with(['userResponsible'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $formattedLogs = $logs->getCollection()->map(function ($revision) {
            return $this->formatRevision($revision);
        });

        $logs->setCollection($formattedLogs);

        // آمار کاربر
        $stats = [
            'total_changes' => Revision::where('user_id', $userId)->count(),
            'last_activity' => Revision::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->first()?->created_at,
            'most_changed_models' => Revision::where('user_id', $userId)
                ->select('revisionable_type', DB::raw('count(*) as count'))
                ->groupBy('revisionable_type')
                ->orderByDesc('count')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'model' => class_basename($item->revisionable_type),
                        'count' => $item->count
                    ];
                })
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'logs' => $logs,
                'statistics' => $stats
            ],
            'message' => 'لاگ‌های کاربر با موفقیت دریافت شد'
        ]);
    }

    /**
     * Get logs of a specific model | دریافت لاگ‌های یک مدل
     * @authenticated
     * @group Revision Logs
     */
    public function modelLogs(Request $request): JsonResponse
    {
        $request->validate([
            'model_type' => 'required|string',
            'model_id' => 'required|integer'
        ]);

        $perPage = $request->get('per_page', 20);

        $logs = Revision::where('revisionable_type', $request->model_type)
            ->where('revisionable_id', $request->model_id)
            ->with(['userResponsible'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $formattedLogs = $logs->getCollection()->map(function ($revision) {
            return $this->formatRevision($revision);
        });

        $logs->setCollection($formattedLogs);

        return response()->json([
            'success' => true,
            'data' => $logs,
            'message' => 'لاگ‌های مدل با موفقیت دریافت شد'
        ]);
    }

    /**
     * Delete old revision logs | حذف لاگ‌های قدیمی
     * @authenticated
     * @group Revision Logs
     */
    public function cleanup(Request $request): JsonResponse
    {
        $request->validate([
            'days' => 'required|integer|min:1'
        ]);

        $days = $request->days;
        $date = Carbon::now()->subDays($days);

        $deletedCount = Revision::where('created_at', '<', $date)->delete();

        return response()->json([
            'success' => true,
            'data' => [
                'deleted_count' => $deletedCount,
                'before_date' => $date->format('Y-m-d H:i:s')
            ],
            'message' => "لاگ‌های قدیمی‌تر از {$days} روز با موفقیت حذف شدند"
        ]);
    }

    /**
     * Show a single revision log | نمایش جزئیات یک لاگ تغییر
     * @authenticated
     * @group Revision Logs
     */
    public function show(int $id): JsonResponse
    {
        $revision = Revision::with(['userResponsible'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $this->formatRevision($revision),
            'message' => 'جزئیات لاگ با موفقیت دریافت شد'
        ]);
    }

    /**
     * Get recent revision activities
     * @authenticated
     * @group Revision Logs
     */
    private function formatRevision(Revision $revision): array
    {
        return [
            'id' => $revision->id,
            'user' => [
                'id' => $revision->user_id,
                'name' => $revision->userResponsible()?->name ?? 'سیستم',
                'email' => $revision->userResponsible()?->email ?? null,
            ],
            'model' => [
                'type' => class_basename($revision->revisionable_type),
                'id' => $revision->revisionable_id,
            ],
            'field' => $revision->fieldName(),
            'old_value' => $revision->oldValue(),
            'new_value' => $revision->newValue(),
            'created_at' => $revision->created_at->format('Y-m-d H:i:s'),
            'created_at_human' => $revision->created_at->diffForHumans(),
        ];
    }

    /**
     * Get recent revision activities
     * @authenticated
     * @group Revision Logs
     */
    public function recentActivity(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 50);

        $activities = Revision::with(['userResponsible'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($revision) {
                return $this->formatRevision($revision);
            });

        return response()->json([
            'success' => true,
            'data' => $activities,
            'message' => 'فعالیت‌های اخیر با موفقیت دریافت شد'
        ]);
    }

    /**
     * Compare two revisions | مقایسه دو لاگ تغییر
     * @authenticated
     * @group Revision Logs
     */
    public function compare(Request $request): JsonResponse
    {
        $request->validate([
            'revision_id_1' => 'required|integer|exists:revisions,id',
            'revision_id_2' => 'required|integer|exists:revisions,id',
        ]);

        $revision1 = Revision::findOrFail($request->revision_id_1);
        $revision2 = Revision::findOrFail($request->revision_id_2);

        return response()->json([
            'success' => true,
            'data' => [
                'revision_1' => $this->formatRevision($revision1),
                'revision_2' => $this->formatRevision($revision2),
            ],
            'message' => 'مقایسه با موفقیت انجام شد'
        ]);
    }
}

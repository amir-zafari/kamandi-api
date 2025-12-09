# Patient Photo Feature - Usage Example

## Overview
The Patient model now supports storing patient photos as base64 encoded images. Photos are automatically resized to 48x48 pixels for consistency and optimal storage.

## API Endpoints That Support Photo

### 1. Create/Update Patient (POST /api/patients)
```json
{
    "for": 1,
    "first_name": "احمد",
    "last_name": "محمدی",
    "national_id": "1234567890",
    "birth_date": "1990-01-15",
    "gender": "male",
    "photo": "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=="
}
```

### 2. Update Patient (PUT /api/patients/{id})
```json
{
    "photo": "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=="
}
```

## Photo Processing Features

✅ **Automatic Resizing**: All photos are automatically resized to 48x48 pixels
✅ **Format Support**: Supports JPEG, PNG, GIF, and other common image formats
✅ **Base64 Storage**: Images are stored as base64 encoded strings in the database
✅ **Memory Management**: Proper cleanup to prevent memory leaks
✅ **Error Handling**: Graceful handling of invalid image data

## Frontend Implementation Example

### JavaScript/React Example
```javascript
// Convert file to base64 and send to API
function handlePhotoUpload(file) {
    const reader = new FileReader();
    reader.onloadend = function() {
        const base64String = reader.result.replace("data:", "").replace(/^.+,/, "");
        
        // Send to API
        fetch('/api/patients', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token
            },
            body: JSON.stringify({
                // ... other patient data
                photo: base64String
            })
        });
    };
    reader.readAsDataURL(file);
}
```

### Display Photo Example
```javascript
// Display photo from API response
function displayPhoto(patient) {
    if (patient.photo) {
        const img = document.createElement('img');
        img.src = `data:image/jpeg;base64,${patient.photo}`;
        img.width = 48;
        img.height = 48;
        document.getElementById('patient-photo').appendChild(img);
    }
}
```

## Database Changes

A new migration has been added:
- **File**: `2025_12_09_141808_add_photo_to_patients_table.php`
- **Field**: `photo` (LONGTEXT, nullable)
- **Comment**: "Base64 encoded patient photo (48x48)"

## Model Changes

The `Patient` model now includes:
- `photo` field in `$fillable` array
- Automatic handling in create/update operations

## Notes

- Photos are optional (nullable field)
- Invalid photo data will return a 422 error with message "Invalid photo format or processing failed"
- Original image aspect ratio is maintained during resize (may result in slight distortion for non-square images)
- Photos are stored as JPEG format after processing (regardless of input format)
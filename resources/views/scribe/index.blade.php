<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "https://kamandi-api.test";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-appointments" class="tocify-header">
                <li class="tocify-item level-1" data-unique="appointments">
                    <a href="#appointments">Appointments</a>
                </li>
                                    <ul id="tocify-subheader-appointments" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="appointments-GETapi-appointments">
                                <a href="#appointments-GETapi-appointments">List all appointments with status filter</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-POSTapi-appointments">
                                <a href="#appointments-POSTapi-appointments">Create a new appointment</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-GETapi-appointments--doctor_id---date-">
                                <a href="#appointments-GETapi-appointments--doctor_id---date-">List all appointments for a doctor on a specific date</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-GETapi-appointments--id-">
                                <a href="#appointments-GETapi-appointments--id-">Show a specific appointment</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-PUTapi-appointments--id-">
                                <a href="#appointments-PUTapi-appointments--id-">Update an appointment</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-DELETEapi-appointments--id-">
                                <a href="#appointments-DELETEapi-appointments--id-">Delete an appointment (soft delete - only for admins)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-POSTapi-appointments-cancel--id-">
                                <a href="#appointments-POSTapi-appointments-cancel--id-">Cancel an appointment</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-POSTapi-patient-appointments">
                                <a href="#appointments-POSTapi-patient-appointments">Create a new appointment</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-GETapi-patient-appointments--doctor_id---date-">
                                <a href="#appointments-GETapi-patient-appointments--doctor_id---date-">List all appointments for a doctor on a specific date</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-GETapi-patient-appointments--patient_id-">
                                <a href="#appointments-GETapi-patient-appointments--patient_id-">List all appointments for a specific patient</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-PUTapi-patient-appointments--id-">
                                <a href="#appointments-PUTapi-patient-appointments--id-">Update an appointment</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-DELETEapi-patient-appointments--id-">
                                <a href="#appointments-DELETEapi-patient-appointments--id-">Delete an appointment (soft delete - only for admins)</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-appointments-attendance" class="tocify-header">
                <li class="tocify-item level-1" data-unique="appointments-attendance">
                    <a href="#appointments-attendance">Appointments - Attendance</a>
                </li>
                                    <ul id="tocify-subheader-appointments-attendance" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="appointments-attendance-POSTapi-appointments-mark-arrived--id-">
                                <a href="#appointments-attendance-POSTapi-appointments-mark-arrived--id-">Mark patient as arrived (Step 1: Patient arrival)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-attendance-POSTapi-appointments-start-visit--id-">
                                <a href="#appointments-attendance-POSTapi-appointments-start-visit--id-">Start the visit and mark as completed (Step 2: Visit begins and completes)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-attendance-GETapi-appointments-statistics--doctor_id---date-">
                                <a href="#appointments-attendance-GETapi-appointments-statistics--doctor_id---date-">Get attendance statistics for a doctor on a specific date</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-GETapi-auth-captcha-generate">
                                <a href="#authentication-GETapi-auth-captcha-generate">Generate captcha image</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-auth-send-otp">
                                <a href="#authentication-POSTapi-auth-send-otp">Send verification code</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-auth-verify-otp">
                                <a href="#authentication-POSTapi-auth-verify-otp">Verify OTP</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-auth-login">
                                <a href="#authentication-POSTapi-auth-login">Login user</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-authentication-protected" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication-protected">
                    <a href="#authentication-protected">Authentication (Protected)</a>
                </li>
                                    <ul id="tocify-subheader-authentication-protected" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-protected-POSTapi-auth-logout">
                                <a href="#authentication-protected-POSTapi-auth-logout">Logout current device</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-protected-POSTapi-auth-logoutall">
                                <a href="#authentication-protected-POSTapi-auth-logoutall">Logout from all devices</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-currency-converter" class="tocify-header">
                <li class="tocify-item level-1" data-unique="currency-converter">
                    <a href="#currency-converter">Currency Converter</a>
                </li>
                                    <ul id="tocify-subheader-currency-converter" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="currency-converter-POSTapi-currency-convert">
                                <a href="#currency-converter-POSTapi-currency-convert">Convert USD to Iranian Toman (IRT)</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-doctor-shifts" class="tocify-header">
                <li class="tocify-item level-1" data-unique="doctor-shifts">
                    <a href="#doctor-shifts">Doctor Shifts</a>
                </li>
                                    <ul id="tocify-subheader-doctor-shifts" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="doctor-shifts-GETapi-shifts--doctor_id-">
                                <a href="#doctor-shifts-GETapi-shifts--doctor_id-">List all shifts for a doctor</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctor-shifts-POSTapi-shifts">
                                <a href="#doctor-shifts-POSTapi-shifts">Create a new shift for a doctor</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctor-shifts-GETapi-shifts--id---day-">
                                <a href="#doctor-shifts-GETapi-shifts--id---day-">Show available slots for a doctor on a specific date</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctor-shifts-PUTapi-shifts--id-">
                                <a href="#doctor-shifts-PUTapi-shifts--id-">Update a doctor's shift</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctor-shifts-DELETEapi-shifts--id-">
                                <a href="#doctor-shifts-DELETEapi-shifts--id-">Delete a doctor's shift</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctor-shifts-GETapi-patient-shifts--doctor_id-">
                                <a href="#doctor-shifts-GETapi-patient-shifts--doctor_id-">List all shifts for a doctor</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctor-shifts-GETapi-patient-shifts--id---day-">
                                <a href="#doctor-shifts-GETapi-patient-shifts--id---day-">Show available slots for a doctor on a specific date</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-doctors" class="tocify-header">
                <li class="tocify-item level-1" data-unique="doctors">
                    <a href="#doctors">Doctors</a>
                </li>
                                    <ul id="tocify-subheader-doctors" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="doctors-GETapi-doctors">
                                <a href="#doctors-GETapi-doctors">List all doctors</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctors-POSTapi-doctors">
                                <a href="#doctors-POSTapi-doctors">Create or update a doctor</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctors-GETapi-doctors--id-">
                                <a href="#doctors-GETapi-doctors--id-">Show doctor details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctors-PUTapi-doctors--id-">
                                <a href="#doctors-PUTapi-doctors--id-">Update doctor information</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctors-DELETEapi-doctors--id-">
                                <a href="#doctors-DELETEapi-doctors--id-">Delete a doctor</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctors-GETapi-patient-doctors">
                                <a href="#doctors-GETapi-patient-doctors">List all doctors</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="doctors-GETapi-patient-doctors--id-">
                                <a href="#doctors-GETapi-patient-doctors--id-">Show doctor details</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-document-records" class="tocify-header">
                <li class="tocify-item level-1" data-unique="document-records">
                    <a href="#document-records">Document Records</a>
                </li>
                                    <ul id="tocify-subheader-document-records" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="document-records-POSTapi-document-records">
                                <a href="#document-records-POSTapi-document-records">ذخیره پرونده اسناد</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="document-records-GETapi-document-records--doctor_id---patient_id-">
                                <a href="#document-records-GETapi-document-records--doctor_id---patient_id-">دریافت پرونده‌های اسناد</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="document-records-PUTapi-document-records--id-">
                                <a href="#document-records-PUTapi-document-records--id-">بروزرسانی پرونده اسناد</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="document-records-DELETEapi-document-records--id-">
                                <a href="#document-records-DELETEapi-document-records--id-">حذف پرونده اسناد</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-PUTapi-prescriptions--id-">
                                <a href="#endpoints-PUTapi-prescriptions--id-">PUT api/prescriptions/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-prescriptions--id-">
                                <a href="#endpoints-DELETEapi-prescriptions--id-">DELETE api/prescriptions/{id}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-handwritten-records" class="tocify-header">
                <li class="tocify-item level-1" data-unique="handwritten-records">
                    <a href="#handwritten-records">Handwritten Records</a>
                </li>
                                    <ul id="tocify-subheader-handwritten-records" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="handwritten-records-POSTapi-handwritten-records">
                                <a href="#handwritten-records-POSTapi-handwritten-records">ذخیره پرونده دست‌نویس</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="handwritten-records-GETapi-handwritten-records--doctor_id---patient_id-">
                                <a href="#handwritten-records-GETapi-handwritten-records--doctor_id---patient_id-">دریافت پرونده‌های دست‌نویس</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="handwritten-records-PUTapi-handwritten-records--id-">
                                <a href="#handwritten-records-PUTapi-handwritten-records--id-">بروزرسانی پرونده دست‌نویس</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="handwritten-records-DELETEapi-handwritten-records--id-">
                                <a href="#handwritten-records-DELETEapi-handwritten-records--id-">حذف پرونده دست‌نویس</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-medical-cases" class="tocify-header">
                <li class="tocify-item level-1" data-unique="medical-cases">
                    <a href="#medical-cases">Medical Cases</a>
                </li>
                                    <ul id="tocify-subheader-medical-cases" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="medical-cases-GETapi-medicaldocument-search">
                                <a href="#medical-cases-GETapi-medicaldocument-search">Search in medical cases</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-cases-GETapi-medicaldocument-filter">
                                <a href="#medical-cases-GETapi-medicaldocument-filter">Filter medical cases by doctor, patient and type</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-cases-POSTapi-medicaldocument">
                                <a href="#medical-cases-POSTapi-medicaldocument">Create a new medical case with optional files</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-cases-GETapi-medicaldocument--doctor_id---patient_id-">
                                <a href="#medical-cases-GETapi-medicaldocument--doctor_id---patient_id-">List all medical cases for a doctor and patient</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-cases-PUTapi-medicaldocument--id-">
                                <a href="#medical-cases-PUTapi-medicaldocument--id-">Update a medical case and optionally add files</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-cases-PATCHapi-medicaldocument-pin--id-">
                                <a href="#medical-cases-PATCHapi-medicaldocument-pin--id-">Toggle the pin status of a medical case</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-cases-DELETEapi-medicaldocument--id-">
                                <a href="#medical-cases-DELETEapi-medicaldocument--id-">Delete a medical case and all associated files</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-cases-DELETEapi-medicaldocument-file--id-">
                                <a href="#medical-cases-DELETEapi-medicaldocument-file--id-">Delete a specific file from a medical case</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-medical-visits" class="tocify-header">
                <li class="tocify-item level-1" data-unique="medical-visits">
                    <a href="#medical-visits">Medical Visits</a>
                </li>
                                    <ul id="tocify-subheader-medical-visits" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="medical-visits-POSTapi-visits">
                                <a href="#medical-visits-POSTapi-visits">Create a new medical visit</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-visits-GETapi-visits--record_id--">
                                <a href="#medical-visits-GETapi-visits--record_id--">List medical visits</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-visits-GETapi-visits--id-">
                                <a href="#medical-visits-GETapi-visits--id-">Show a specific medical visit</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-visits-PUTapi-visits--id-">
                                <a href="#medical-visits-PUTapi-visits--id-">Update a medical visit</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="medical-visits-DELETEapi-visits--id-">
                                <a href="#medical-visits-DELETEapi-visits--id-">Delete a medical visit</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-patients" class="tocify-header">
                <li class="tocify-item level-1" data-unique="patients">
                    <a href="#patients">Patients</a>
                </li>
                                    <ul id="tocify-subheader-patients" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="patients-GETapi-patients-search">
                                <a href="#patients-GETapi-patients-search">Search patients</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-GETapi-patients">
                                <a href="#patients-GETapi-patients">List all patients with special appointments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-POSTapi-patients">
                                <a href="#patients-POSTapi-patients">Create or update a patient</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-GETapi-patients--id-">
                                <a href="#patients-GETapi-patients--id-">Show patient details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-PUTapi-patients--id-">
                                <a href="#patients-PUTapi-patients--id-">Update patient information</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-DELETEapi-patients--id-">
                                <a href="#patients-DELETEapi-patients--id-">Delete a patient</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-GETapi-patient-patients">
                                <a href="#patients-GETapi-patient-patients">List the logged-in user's patients</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-POSTapi-patient-patients">
                                <a href="#patients-POSTapi-patient-patients">Create or update a patient</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-GETapi-patient-patients--id-">
                                <a href="#patients-GETapi-patient-patients--id-">Show patient details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-PUTapi-patient-patients--id-">
                                <a href="#patients-PUTapi-patient-patients--id-">Update patient information</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-DELETEapi-patient-patients--id-">
                                <a href="#patients-DELETEapi-patient-patients--id-">Delete a patient</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-prescriptions" class="tocify-header">
                <li class="tocify-item level-1" data-unique="prescriptions">
                    <a href="#prescriptions">Prescriptions</a>
                </li>
                                    <ul id="tocify-subheader-prescriptions" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="prescriptions-POSTapi-prescriptions">
                                <a href="#prescriptions-POSTapi-prescriptions">Create a new prescription</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="prescriptions-GETapi-prescriptions--record_id--">
                                <a href="#prescriptions-GETapi-prescriptions--record_id--">List prescriptions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="prescriptions-GETapi-prescriptions--id-">
                                <a href="#prescriptions-GETapi-prescriptions--id-">Show a prescription</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-revision-logs" class="tocify-header">
                <li class="tocify-item level-1" data-unique="revision-logs">
                    <a href="#revision-logs">Revision Logs</a>
                </li>
                                    <ul id="tocify-subheader-revision-logs" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="revision-logs-GETapi-logs">
                                <a href="#revision-logs-GETapi-logs">Get all revision logs</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="revision-logs-GETapi-logs-statistics">
                                <a href="#revision-logs-GETapi-logs-statistics">Get revision log statistics</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="revision-logs-GETapi-logs-recent-activity">
                                <a href="#revision-logs-GETapi-logs-recent-activity">Get recent revision activities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="revision-logs-GETapi-logs-user--userId-">
                                <a href="#revision-logs-GETapi-logs-user--userId-">Get logs of a specific user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="revision-logs-GETapi-logs-model">
                                <a href="#revision-logs-GETapi-logs-model">Get logs of a specific model</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="revision-logs-GETapi-logs--id-">
                                <a href="#revision-logs-GETapi-logs--id-">Show a single revision log</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="revision-logs-POSTapi-logs-compare">
                                <a href="#revision-logs-POSTapi-logs-compare">Compare two revisions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="revision-logs-DELETEapi-logs-cleanup">
                                <a href="#revision-logs-DELETEapi-logs-cleanup">Delete old revision logs</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-text-records" class="tocify-header">
                <li class="tocify-item level-1" data-unique="text-records">
                    <a href="#text-records">Text Records</a>
                </li>
                                    <ul id="tocify-subheader-text-records" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="text-records-POSTapi-text-records">
                                <a href="#text-records-POSTapi-text-records">ذخیره پرونده متنی</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="text-records-GETapi-text-records--doctor_id---patient_id-">
                                <a href="#text-records-GETapi-text-records--doctor_id---patient_id-">دریافت پرونده‌های متنی</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="text-records-PUTapi-text-records--id-">
                                <a href="#text-records-PUTapi-text-records--id-">بروزرسانی پرونده متنی</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="text-records-DELETEapi-text-records--id-">
                                <a href="#text-records-DELETEapi-text-records--id-">حذف پرونده متنی</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-users" class="tocify-header">
                <li class="tocify-item level-1" data-unique="users">
                    <a href="#users">Users</a>
                </li>
                                    <ul id="tocify-subheader-users" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="users-GETapi-users-profile">
                                <a href="#users-GETapi-users-profile">Show the logged-in user's profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-GETapi-users">
                                <a href="#users-GETapi-users">List all users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-POSTapi-users">
                                <a href="#users-POSTapi-users">Create a new user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-GETapi-users--id-">
                                <a href="#users-GETapi-users--id-">Show user details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-PUTapi-users--id-">
                                <a href="#users-PUTapi-users--id-">Update user information</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-DELETEapi-users--id-">
                                <a href="#users-DELETEapi-users--id-">Delete a user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="users-GETapi-patient-profile">
                                <a href="#users-GETapi-patient-profile">Show the logged-in user's profile</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-visit-reports" class="tocify-header">
                <li class="tocify-item level-1" data-unique="visit-reports">
                    <a href="#visit-reports">Visit Reports</a>
                </li>
                                    <ul id="tocify-subheader-visit-reports" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="visit-reports-POSTapi-visit-reports">
                                <a href="#visit-reports-POSTapi-visit-reports">ایجاد گزارش ویزیت (CaseMedical + Visit)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="visit-reports-GETapi-visit-reports--doctor_id---patient_id-">
                                <a href="#visit-reports-GETapi-visit-reports--doctor_id---patient_id-">دریافت گزارش‌های ویزیت</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="visit-reports-PUTapi-visit-reports--id-">
                                <a href="#visit-reports-PUTapi-visit-reports--id-">بروزرسانی گزارش ویزیت</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="visit-reports-DELETEapi-visit-reports--id-">
                                <a href="#visit-reports-DELETEapi-visit-reports--id-">حذف گزارش ویزیت</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: December 11, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>https://kamandi-api.test</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer Bearer {YOUR_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>To use this API, send your token in the Authorization header as a Bearer token.</p>

        <h1 id="appointments">Appointments</h1>

    

                                <h2 id="appointments-GETapi-appointments">List all appointments with status filter</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a list of all appointments with optional filters for status, attendance, date, and doctor.</p>

<span id="example-requests-GETapi-appointments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/appointments?status=waiting&amp;attended=arrived&amp;date=2024-01-15&amp;doctor_id=1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments"
);

const params = {
    "status": "waiting",
    "attended": "arrived",
    "date": "2024-01-15",
    "doctor_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-appointments">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;appointments&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;patient_name&quot;: &quot;احمد محمدی&quot;,
            &quot;national_code&quot;: &quot;1234567890&quot;,
            &quot;mobile&quot;: &quot;09123456789&quot;,
            &quot;date&quot;: &quot;2024-01-15&quot;,
            &quot;start_time&quot;: &quot;09:00&quot;,
            &quot;status&quot;: &quot;waiting&quot;,
            &quot;attended&quot;: &quot;not_arrived&quot;,
            &quot;attended_label&quot;: &quot;حاضر نشده&quot;,
            &quot;appointment_type&quot;: &quot;online&quot;,
            &quot;service_type&quot;: &quot;doctor&quot;,
            &quot;is_cancelable&quot;: true,
            &quot;is_editable&quot;: true,
            &quot;arrival_time&quot;: null,
            &quot;waiting_time&quot;: null
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-appointments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-appointments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-appointments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-appointments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-appointments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-appointments" data-method="GET"
      data-path="api/appointments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-appointments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-appointments"
                    onclick="tryItOut('GETapi-appointments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-appointments"
                    onclick="cancelTryOut('GETapi-appointments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-appointments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/appointments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-appointments"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-appointments"
               value="waiting"
               data-component="query">
    <br>
<p>Filter by appointment status. Example: <code>waiting</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>attended</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="attended"                data-endpoint="GETapi-appointments"
               value="arrived"
               data-component="query">
    <br>
<p>Filter by attendance status. Example: <code>arrived</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="GETapi-appointments"
               value="2024-01-15"
               data-component="query">
    <br>
<p>Filter by appointment date (Y-m-d format). Example: <code>2024-01-15</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="GETapi-appointments"
               value="1"
               data-component="query">
    <br>
<p>Filter by doctor ID. Example: <code>1</code></p>
            </div>
                </form>

                    <h2 id="appointments-POSTapi-appointments">Create a new appointment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Book a new appointment for a patient with a doctor at a specific time.</p>

<span id="example-requests-POSTapi-appointments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/appointments" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"doctor_id\": 1,
    \"patient_id\": 5,
    \"date\": \"2024-01-15\",
    \"start_time\": \"09:00\",
    \"appointment_type\": \"online\",
    \"service_type\": \"doctor\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "doctor_id": 1,
    "patient_id": 5,
    "date": "2024-01-15",
    "start_time": "09:00",
    "appointment_type": "online",
    "service_type": "doctor"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-appointments">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Appointment booked successfully.&quot;,
    &quot;appointment&quot;: {
        &quot;id&quot;: 1,
        &quot;doctor_id&quot;: 1,
        &quot;patient_id&quot;: 5,
        &quot;date&quot;: &quot;2024-01-15&quot;,
        &quot;start_time&quot;: &quot;09:00&quot;,
        &quot;status&quot;: &quot;waiting&quot;,
        &quot;appointment_type&quot;: &quot;online&quot;,
        &quot;service_type&quot;: &quot;doctor&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Cannot book appointment in the past.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (409):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Doctor already has an appointment at this time.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;doctor_id&quot;: [
            &quot;The doctor id field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-appointments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-appointments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-appointments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-appointments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-appointments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-appointments" data-method="POST"
      data-path="api/appointments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-appointments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-appointments"
                    onclick="tryItOut('POSTapi-appointments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-appointments"
                    onclick="cancelTryOut('POSTapi-appointments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-appointments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/appointments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-appointments"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="POSTapi-appointments"
               value="1"
               data-component="body">
    <br>
<p>The doctor's ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="POSTapi-appointments"
               value="5"
               data-component="body">
    <br>
<p>The patient's ID. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="POSTapi-appointments"
               value="2024-01-15"
               data-component="body">
    <br>
<p>Appointment date in Y-m-d format. Example: <code>2024-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="POSTapi-appointments"
               value="09:00"
               data-component="body">
    <br>
<p>Appointment start time in HH:MM format. Example: <code>09:00</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>appointment_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="appointment_type"                data-endpoint="POSTapi-appointments"
               value="online"
               data-component="body">
    <br>
<p>Type of appointment. Example: <code>online</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_type"                data-endpoint="POSTapi-appointments"
               value="doctor"
               data-component="body">
    <br>
<p>Type of service. Example: <code>doctor</code></p>
        </div>
        </form>

                    <h2 id="appointments-GETapi-appointments--doctor_id---date-">List all appointments for a doctor on a specific date</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-appointments--doctor_id---date-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/appointments/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-appointments--doctor_id---date-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-appointments--doctor_id---date-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-appointments--doctor_id---date-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-appointments--doctor_id---date-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-appointments--doctor_id---date-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-appointments--doctor_id---date-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-appointments--doctor_id---date-" data-method="GET"
      data-path="api/appointments/{doctor_id}/{date}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-appointments--doctor_id---date-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-appointments--doctor_id---date-"
                    onclick="tryItOut('GETapi-appointments--doctor_id---date-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-appointments--doctor_id---date-"
                    onclick="cancelTryOut('GETapi-appointments--doctor_id---date-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-appointments--doctor_id---date-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/appointments/{doctor_id}/{date}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-appointments--doctor_id---date-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-appointments--doctor_id---date-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-appointments--doctor_id---date-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-appointments--doctor_id---date-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="GETapi-appointments--doctor_id---date-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="appointments-GETapi-appointments--id-">Show a specific appointment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get detailed information about a specific appointment by its ID.</p>

<span id="example-requests-GETapi-appointments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/appointments/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-appointments--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;appointment&quot;: {
        &quot;id&quot;: 1,
        &quot;doctor_id&quot;: 1,
        &quot;patient_id&quot;: 5,
        &quot;date&quot;: &quot;2024-01-15&quot;,
        &quot;start_time&quot;: &quot;09:00&quot;,
        &quot;status&quot;: &quot;waiting&quot;,
        &quot;attended_label&quot;: &quot;حاضر نشده&quot;,
        &quot;is_cancelable&quot;: true,
        &quot;is_editable&quot;: true,
        &quot;can_mark_attended&quot;: true,
        &quot;can_start_visit&quot;: false
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Appointment not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-appointments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-appointments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-appointments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-appointments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-appointments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-appointments--id-" data-method="GET"
      data-path="api/appointments/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-appointments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-appointments--id-"
                    onclick="tryItOut('GETapi-appointments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-appointments--id-"
                    onclick="cancelTryOut('GETapi-appointments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-appointments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/appointments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-appointments--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-appointments--id-"
               value="1"
               data-component="url">
    <br>
<p>The appointment ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="appointments-PUTapi-appointments--id-">Update an appointment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-appointments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/appointments/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"start_time\": \"(:05\",
    \"appointment_type\": \"in_person\",
    \"service_type\": \"injection\",
    \"status\": \"waiting\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "start_time": "(:05",
    "appointment_type": "in_person",
    "service_type": "injection",
    "status": "waiting"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-appointments--id-">
</span>
<span id="execution-results-PUTapi-appointments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-appointments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-appointments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-appointments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-appointments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-appointments--id-" data-method="PUT"
      data-path="api/appointments/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-appointments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-appointments--id-"
                    onclick="tryItOut('PUTapi-appointments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-appointments--id-"
                    onclick="cancelTryOut('PUTapi-appointments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-appointments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/appointments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-appointments--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-appointments--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the appointment. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="PUTapi-appointments--id-"
               value="(:05"
               data-component="body">
    <br>
<p>Must match the regex /^(?:[01]\d. Example: <code>(:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>appointment_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="appointment_type"                data-endpoint="PUTapi-appointments--id-"
               value="in_person"
               data-component="body">
    <br>
<p>Example: <code>in_person</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>online</code></li> <li><code>phone</code></li> <li><code>in_person</code></li> <li><code>referral</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_type"                data-endpoint="PUTapi-appointments--id-"
               value="injection"
               data-component="body">
    <br>
<p>Example: <code>injection</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>doctor</code></li> <li><code>injection</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-appointments--id-"
               value="waiting"
               data-component="body">
    <br>
<p>Example: <code>waiting</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>waiting</code></li> <li><code>canceled</code></li> <li><code>visited</code></li> <li><code>no_show</code></li></ul>
        </div>
        </form>

                    <h2 id="appointments-DELETEapi-appointments--id-">Delete an appointment (soft delete - only for admins)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-appointments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/appointments/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-appointments--id-">
</span>
<span id="execution-results-DELETEapi-appointments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-appointments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-appointments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-appointments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-appointments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-appointments--id-" data-method="DELETE"
      data-path="api/appointments/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-appointments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-appointments--id-"
                    onclick="tryItOut('DELETEapi-appointments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-appointments--id-"
                    onclick="cancelTryOut('DELETEapi-appointments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-appointments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/appointments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-appointments--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-appointments--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the appointment. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="appointments-POSTapi-appointments-cancel--id-">Cancel an appointment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Cancel an existing appointment with a reason. Different rules apply based on user role.</p>

<span id="example-requests-POSTapi-appointments-cancel--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/appointments/cancel/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"cancel_reason\": \"بیمار نمی‌تواند حاضر شود\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments/cancel/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "cancel_reason": "بیمار نمی‌تواند حاضر شود"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-appointments-cancel--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Appointment canceled successfully.&quot;,
    &quot;appointment&quot;: {
        &quot;id&quot;: 1,
        &quot;status&quot;: &quot;canceled&quot;,
        &quot;canceled_by&quot;: 1,
        &quot;canceled_at&quot;: &quot;2024-01-15T10:30:00&quot;,
        &quot;cancel_reason&quot;: &quot;بیمار نمی&zwnj;تواند حاضر شود&quot;
    },
    &quot;canceled_by_role&quot;: &quot;patient&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Patients can only cancel appointments at least 2 hours before the scheduled time.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Appointment not found.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;cancel_reason&quot;: [
            &quot;The cancel reason field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-appointments-cancel--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-appointments-cancel--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-appointments-cancel--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-appointments-cancel--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-appointments-cancel--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-appointments-cancel--id-" data-method="POST"
      data-path="api/appointments/cancel/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-appointments-cancel--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-appointments-cancel--id-"
                    onclick="tryItOut('POSTapi-appointments-cancel--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-appointments-cancel--id-"
                    onclick="cancelTryOut('POSTapi-appointments-cancel--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-appointments-cancel--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/appointments/cancel/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-appointments-cancel--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-appointments-cancel--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-appointments-cancel--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-appointments-cancel--id-"
               value="1"
               data-component="url">
    <br>
<p>The appointment ID to cancel. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cancel_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cancel_reason"                data-endpoint="POSTapi-appointments-cancel--id-"
               value="بیمار نمی‌تواند حاضر شود"
               data-component="body">
    <br>
<p>Reason for cancellation (min 3, max 500 characters). Example: <code>بیمار نمی‌تواند حاضر شود</code></p>
        </div>
        </form>

                    <h2 id="appointments-POSTapi-patient-appointments">Create a new appointment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Book a new appointment for a patient with a doctor at a specific time.</p>

<span id="example-requests-POSTapi-patient-appointments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/patient/appointments" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"doctor_id\": 1,
    \"patient_id\": 5,
    \"date\": \"2024-01-15\",
    \"start_time\": \"09:00\",
    \"appointment_type\": \"online\",
    \"service_type\": \"doctor\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/appointments"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "doctor_id": 1,
    "patient_id": 5,
    "date": "2024-01-15",
    "start_time": "09:00",
    "appointment_type": "online",
    "service_type": "doctor"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-patient-appointments">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Appointment booked successfully.&quot;,
    &quot;appointment&quot;: {
        &quot;id&quot;: 1,
        &quot;doctor_id&quot;: 1,
        &quot;patient_id&quot;: 5,
        &quot;date&quot;: &quot;2024-01-15&quot;,
        &quot;start_time&quot;: &quot;09:00&quot;,
        &quot;status&quot;: &quot;waiting&quot;,
        &quot;appointment_type&quot;: &quot;online&quot;,
        &quot;service_type&quot;: &quot;doctor&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Cannot book appointment in the past.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (409):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Doctor already has an appointment at this time.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;doctor_id&quot;: [
            &quot;The doctor id field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-patient-appointments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-patient-appointments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-patient-appointments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-patient-appointments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-patient-appointments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-patient-appointments" data-method="POST"
      data-path="api/patient/appointments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-patient-appointments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-patient-appointments"
                    onclick="tryItOut('POSTapi-patient-appointments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-patient-appointments"
                    onclick="cancelTryOut('POSTapi-patient-appointments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-patient-appointments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/patient/appointments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-patient-appointments"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-patient-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-patient-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="POSTapi-patient-appointments"
               value="1"
               data-component="body">
    <br>
<p>The doctor's ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="POSTapi-patient-appointments"
               value="5"
               data-component="body">
    <br>
<p>The patient's ID. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="POSTapi-patient-appointments"
               value="2024-01-15"
               data-component="body">
    <br>
<p>Appointment date in Y-m-d format. Example: <code>2024-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="POSTapi-patient-appointments"
               value="09:00"
               data-component="body">
    <br>
<p>Appointment start time in HH:MM format. Example: <code>09:00</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>appointment_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="appointment_type"                data-endpoint="POSTapi-patient-appointments"
               value="online"
               data-component="body">
    <br>
<p>Type of appointment. Example: <code>online</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_type"                data-endpoint="POSTapi-patient-appointments"
               value="doctor"
               data-component="body">
    <br>
<p>Type of service. Example: <code>doctor</code></p>
        </div>
        </form>

                    <h2 id="appointments-GETapi-patient-appointments--doctor_id---date-">List all appointments for a doctor on a specific date</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-patient-appointments--doctor_id---date-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patient/appointments/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/appointments/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patient-appointments--doctor_id---date-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patient-appointments--doctor_id---date-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patient-appointments--doctor_id---date-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patient-appointments--doctor_id---date-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patient-appointments--doctor_id---date-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patient-appointments--doctor_id---date-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patient-appointments--doctor_id---date-" data-method="GET"
      data-path="api/patient/appointments/{doctor_id}/{date}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patient-appointments--doctor_id---date-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patient-appointments--doctor_id---date-"
                    onclick="tryItOut('GETapi-patient-appointments--doctor_id---date-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patient-appointments--doctor_id---date-"
                    onclick="cancelTryOut('GETapi-patient-appointments--doctor_id---date-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patient-appointments--doctor_id---date-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patient/appointments/{doctor_id}/{date}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patient-appointments--doctor_id---date-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patient-appointments--doctor_id---date-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patient-appointments--doctor_id---date-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-patient-appointments--doctor_id---date-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="GETapi-patient-appointments--doctor_id---date-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="appointments-GETapi-patient-appointments--patient_id-">List all appointments for a specific patient</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-patient-appointments--patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patient/appointments/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/appointments/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patient-appointments--patient_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patient-appointments--patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patient-appointments--patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patient-appointments--patient_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patient-appointments--patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patient-appointments--patient_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patient-appointments--patient_id-" data-method="GET"
      data-path="api/patient/appointments/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patient-appointments--patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patient-appointments--patient_id-"
                    onclick="tryItOut('GETapi-patient-appointments--patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patient-appointments--patient_id-"
                    onclick="cancelTryOut('GETapi-patient-appointments--patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patient-appointments--patient_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patient/appointments/{patient_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patient-appointments--patient_id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patient-appointments--patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patient-appointments--patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="GETapi-patient-appointments--patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="appointments-PUTapi-patient-appointments--id-">Update an appointment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-patient-appointments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/patient/appointments/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"start_time\": \"(:05\",
    \"appointment_type\": \"in_person\",
    \"service_type\": \"injection\",
    \"status\": \"no_show\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/appointments/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "start_time": "(:05",
    "appointment_type": "in_person",
    "service_type": "injection",
    "status": "no_show"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-patient-appointments--id-">
</span>
<span id="execution-results-PUTapi-patient-appointments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-patient-appointments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-patient-appointments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-patient-appointments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-patient-appointments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-patient-appointments--id-" data-method="PUT"
      data-path="api/patient/appointments/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-patient-appointments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-patient-appointments--id-"
                    onclick="tryItOut('PUTapi-patient-appointments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-patient-appointments--id-"
                    onclick="cancelTryOut('PUTapi-patient-appointments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-patient-appointments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/patient/appointments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-patient-appointments--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-patient-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-patient-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-patient-appointments--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the appointment. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="PUTapi-patient-appointments--id-"
               value="(:05"
               data-component="body">
    <br>
<p>Must match the regex /^(?:[01]\d. Example: <code>(:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>appointment_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="appointment_type"                data-endpoint="PUTapi-patient-appointments--id-"
               value="in_person"
               data-component="body">
    <br>
<p>Example: <code>in_person</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>online</code></li> <li><code>phone</code></li> <li><code>in_person</code></li> <li><code>referral</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_type"                data-endpoint="PUTapi-patient-appointments--id-"
               value="injection"
               data-component="body">
    <br>
<p>Example: <code>injection</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>doctor</code></li> <li><code>injection</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-patient-appointments--id-"
               value="no_show"
               data-component="body">
    <br>
<p>Example: <code>no_show</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>waiting</code></li> <li><code>canceled</code></li> <li><code>visited</code></li> <li><code>no_show</code></li></ul>
        </div>
        </form>

                    <h2 id="appointments-DELETEapi-patient-appointments--id-">Delete an appointment (soft delete - only for admins)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-patient-appointments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/patient/appointments/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/appointments/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-patient-appointments--id-">
</span>
<span id="execution-results-DELETEapi-patient-appointments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-patient-appointments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-patient-appointments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-patient-appointments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-patient-appointments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-patient-appointments--id-" data-method="DELETE"
      data-path="api/patient/appointments/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-patient-appointments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-patient-appointments--id-"
                    onclick="tryItOut('DELETEapi-patient-appointments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-patient-appointments--id-"
                    onclick="cancelTryOut('DELETEapi-patient-appointments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-patient-appointments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/patient/appointments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-patient-appointments--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-patient-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-patient-appointments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-patient-appointments--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the appointment. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="appointments-attendance">Appointments - Attendance</h1>

    

                                <h2 id="appointments-attendance-POSTapi-appointments-mark-arrived--id-">Mark patient as arrived (Step 1: Patient arrival)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mark a patient as arrived for their appointment. Only doctors, nurses, and admins can perform this action.</p>

<span id="example-requests-POSTapi-appointments-mark-arrived--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/appointments/mark-arrived/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"attendance_notes\": \"بیمار با تاخیر حاضر شد\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments/mark-arrived/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "attendance_notes": "بیمار با تاخیر حاضر شد"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-appointments-mark-arrived--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Patient marked as arrived successfully.&quot;,
    &quot;appointment&quot;: {
        &quot;id&quot;: 1,
        &quot;attended&quot;: &quot;arrived&quot;,
        &quot;arrival_time&quot;: &quot;2024-01-15T09:05:00&quot;,
        &quot;attendance_notes&quot;: &quot;بیمار با تاخیر حاضر شد&quot;
    },
    &quot;marked_by&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;دکتر احمد محمدی&quot;,
        &quot;role&quot;: &quot;doctor&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;You do not have permission to mark attendance.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Appointment not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-appointments-mark-arrived--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-appointments-mark-arrived--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-appointments-mark-arrived--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-appointments-mark-arrived--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-appointments-mark-arrived--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-appointments-mark-arrived--id-" data-method="POST"
      data-path="api/appointments/mark-arrived/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-appointments-mark-arrived--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-appointments-mark-arrived--id-"
                    onclick="tryItOut('POSTapi-appointments-mark-arrived--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-appointments-mark-arrived--id-"
                    onclick="cancelTryOut('POSTapi-appointments-mark-arrived--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-appointments-mark-arrived--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/appointments/mark-arrived/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-appointments-mark-arrived--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-appointments-mark-arrived--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-appointments-mark-arrived--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-appointments-mark-arrived--id-"
               value="1"
               data-component="url">
    <br>
<p>The appointment ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attendance_notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="attendance_notes"                data-endpoint="POSTapi-appointments-mark-arrived--id-"
               value="بیمار با تاخیر حاضر شد"
               data-component="body">
    <br>
<p>Optional notes about the patient's arrival. Example: <code>بیمار با تاخیر حاضر شد</code></p>
        </div>
        </form>

                    <h2 id="appointments-attendance-POSTapi-appointments-start-visit--id-">Start the visit and mark as completed (Step 2: Visit begins and completes)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Start and complete the visit for an appointment. Only doctors and admins can perform this action.</p>

<span id="example-requests-POSTapi-appointments-start-visit--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/appointments/start-visit/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"visit_notes\": \"ویزیت عادی انجام شد\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments/start-visit/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "visit_notes": "ویزیت عادی انجام شد"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-appointments-start-visit--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Visit completed successfully.&quot;,
    &quot;appointment&quot;: {
        &quot;id&quot;: 1,
        &quot;attended&quot;: &quot;completed&quot;,
        &quot;status&quot;: &quot;visited&quot;,
        &quot;visit_start_time&quot;: &quot;2024-01-15T09:15:00&quot;,
        &quot;waiting_time&quot;: 10
    },
    &quot;waiting_time_minutes&quot;: 10
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Only doctors can start visits.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Appointment not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-appointments-start-visit--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-appointments-start-visit--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-appointments-start-visit--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-appointments-start-visit--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-appointments-start-visit--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-appointments-start-visit--id-" data-method="POST"
      data-path="api/appointments/start-visit/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-appointments-start-visit--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-appointments-start-visit--id-"
                    onclick="tryItOut('POSTapi-appointments-start-visit--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-appointments-start-visit--id-"
                    onclick="cancelTryOut('POSTapi-appointments-start-visit--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-appointments-start-visit--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/appointments/start-visit/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-appointments-start-visit--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-appointments-start-visit--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-appointments-start-visit--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-appointments-start-visit--id-"
               value="1"
               data-component="url">
    <br>
<p>The appointment ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visit_notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="visit_notes"                data-endpoint="POSTapi-appointments-start-visit--id-"
               value="ویزیت عادی انجام شد"
               data-component="body">
    <br>
<p>Optional notes about the visit. Example: <code>ویزیت عادی انجام شد</code></p>
        </div>
        </form>

                    <h2 id="appointments-attendance-GETapi-appointments-statistics--doctor_id---date-">Get attendance statistics for a doctor on a specific date</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-appointments-statistics--doctor_id---date-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/appointments/statistics/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/appointments/statistics/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-appointments-statistics--doctor_id---date-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-appointments-statistics--doctor_id---date-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-appointments-statistics--doctor_id---date-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-appointments-statistics--doctor_id---date-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-appointments-statistics--doctor_id---date-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-appointments-statistics--doctor_id---date-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-appointments-statistics--doctor_id---date-" data-method="GET"
      data-path="api/appointments/statistics/{doctor_id}/{date}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-appointments-statistics--doctor_id---date-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-appointments-statistics--doctor_id---date-"
                    onclick="tryItOut('GETapi-appointments-statistics--doctor_id---date-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-appointments-statistics--doctor_id---date-"
                    onclick="cancelTryOut('GETapi-appointments-statistics--doctor_id---date-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-appointments-statistics--doctor_id---date-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/appointments/statistics/{doctor_id}/{date}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-appointments-statistics--doctor_id---date-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-appointments-statistics--doctor_id---date-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-appointments-statistics--doctor_id---date-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-appointments-statistics--doctor_id---date-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="GETapi-appointments-statistics--doctor_id---date-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="authentication">Authentication</h1>

    

                                <h2 id="authentication-GETapi-auth-captcha-generate">Generate captcha image</h2>

<p>
</p>

<p>Generate a new captcha image with unique ID for authentication purposes.</p>

<span id="example-requests-GETapi-auth-captcha-generate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/auth/captcha/generate" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/auth/captcha/generate"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-captcha-generate">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;captcha_id&quot;: &quot;550e8400-e29b-41d4-a716-446655440000&quot;,
    &quot;image&quot;: &quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAA...&quot;,
    &quot;expires_in&quot;: 120
}</code>
 </pre>
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Failed to generate captcha&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-captcha-generate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-captcha-generate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-captcha-generate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-captcha-generate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-captcha-generate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-captcha-generate" data-method="GET"
      data-path="api/auth/captcha/generate"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-captcha-generate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-captcha-generate"
                    onclick="tryItOut('GETapi-auth-captcha-generate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-captcha-generate"
                    onclick="cancelTryOut('GETapi-auth-captcha-generate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-captcha-generate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/captcha/generate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-captcha-generate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-auth-captcha-generate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-POSTapi-auth-send-otp">Send verification code</h2>

<p>
</p>

<p>Send an OTP verification code to user's mobile number for authentication.</p>

<span id="example-requests-POSTapi-auth-send-otp">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/auth/send-otp" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"mobile\": \"09123456789\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/auth/send-otp"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "mobile": "09123456789"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-send-otp">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;کد تأیید ارسال شد&quot;,
    &quot;otp&quot;: 123456
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;mobile&quot;: [
        &quot;The mobile field is required.&quot;
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-send-otp" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-send-otp"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-send-otp"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-send-otp" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-send-otp">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-send-otp" data-method="POST"
      data-path="api/auth/send-otp"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-send-otp', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-send-otp"
                    onclick="tryItOut('POSTapi-auth-send-otp');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-send-otp"
                    onclick="cancelTryOut('POSTapi-auth-send-otp');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-send-otp"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/send-otp</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-send-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-send-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mobile</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mobile"                data-endpoint="POSTapi-auth-send-otp"
               value="09123456789"
               data-component="body">
    <br>
<p>Iranian mobile number (09xxxxxxxxx format). Example: <code>09123456789</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-auth-verify-otp">Verify OTP</h2>

<p>
</p>

<p>Verify the OTP code sent to user's mobile number and return authentication token.</p>

<span id="example-requests-POSTapi-auth-verify-otp">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/auth/verify-otp" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"mobile\": \"09123456789\",
    \"otp\": \"123456\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/auth/verify-otp"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "mobile": "09123456789",
    "otp": "123456"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-verify-otp">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;access_token&quot;: &quot;1|token_string_here&quot;,
    &quot;token_type&quot;: &quot;Bearer&quot;,
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;احمد&quot;,
        &quot;last_name&quot;: &quot;محمدی&quot;,
        &quot;roll&quot;: &quot;patient&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid verification code&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Verification code has expired&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;mobile&quot;: [
        &quot;The mobile field is required.&quot;
    ],
    &quot;otp&quot;: [
        &quot;The otp must be 6 digits.&quot;
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-verify-otp" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-verify-otp"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-verify-otp"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-verify-otp" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-verify-otp">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-verify-otp" data-method="POST"
      data-path="api/auth/verify-otp"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-verify-otp', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-verify-otp"
                    onclick="tryItOut('POSTapi-auth-verify-otp');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-verify-otp"
                    onclick="cancelTryOut('POSTapi-auth-verify-otp');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-verify-otp"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/verify-otp</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-verify-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-verify-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mobile</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mobile"                data-endpoint="POSTapi-auth-verify-otp"
               value="09123456789"
               data-component="body">
    <br>
<p>Iranian mobile number (09xxxxxxxxx format). Example: <code>09123456789</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>otp</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="otp"                data-endpoint="POSTapi-auth-verify-otp"
               value="123456"
               data-component="body">
    <br>
<p>6-digit OTP code. Example: <code>123456</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-auth-login">Login user</h2>

<p>
</p>

<p>Authenticate a user with email/mobile and password, along with captcha verification.</p>

<span id="example-requests-POSTapi-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"mobile\": \"09123456789\",
    \"password\": \"password123\",
    \"captcha_id\": \"uuid-string\",
    \"answer\": \"ABC12\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "mobile": "09123456789",
    "password": "password123",
    "captcha_id": "uuid-string",
    "answer": "ABC12"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;access_token&quot;: &quot;1|token_string_here&quot;,
    &quot;token_type&quot;: &quot;Bearer&quot;,
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;احمد&quot;,
        &quot;last_name&quot;: &quot;محمدی&quot;,
        &quot;roll&quot;: &quot;patient&quot;,
        &quot;mobile&quot;: &quot;09123456789&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Captcha expired&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid login credentials&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid identifier format&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-login" data-method="POST"
      data-path="api/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-login"
                    onclick="tryItOut('POSTapi-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-login"
                    onclick="cancelTryOut('POSTapi-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mobile</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mobile"                data-endpoint="POSTapi-auth-login"
               value="09123456789"
               data-component="body">
    <br>
<p>Email or mobile number for authentication. Example: <code>09123456789</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-login"
               value="password123"
               data-component="body">
    <br>
<p>User's password. Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>captcha_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="captcha_id"                data-endpoint="POSTapi-auth-login"
               value="uuid-string"
               data-component="body">
    <br>
<p>Captcha ID received from captcha generation. Example: <code>uuid-string</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>answer</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="answer"                data-endpoint="POSTapi-auth-login"
               value="ABC12"
               data-component="body">
    <br>
<p>Captcha answer. Example: <code>ABC12</code></p>
        </div>
        </form>

                <h1 id="authentication-protected">Authentication (Protected)</h1>

    

                                <h2 id="authentication-protected-POSTapi-auth-logout">Logout current device</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/auth/logout" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/auth/logout"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-logout">
</span>
<span id="execution-results-POSTapi-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-logout" data-method="POST"
      data-path="api/auth/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-logout"
                    onclick="tryItOut('POSTapi-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-logout"
                    onclick="cancelTryOut('POSTapi-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-auth-logout"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-protected-POSTapi-auth-logoutall">Logout from all devices</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-auth-logoutall">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/auth/logoutall" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/auth/logoutall"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-logoutall">
</span>
<span id="execution-results-POSTapi-auth-logoutall" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-logoutall"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-logoutall"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-logoutall" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-logoutall">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-logoutall" data-method="POST"
      data-path="api/auth/logoutall"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-logoutall', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-logoutall"
                    onclick="tryItOut('POSTapi-auth-logoutall');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-logoutall"
                    onclick="cancelTryOut('POSTapi-auth-logoutall');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-logoutall"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/logoutall</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-auth-logoutall"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-logoutall"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-logoutall"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="currency-converter">Currency Converter</h1>

    

                                <h2 id="currency-converter-POSTapi-currency-convert">Convert USD to Iranian Toman (IRT)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Convert USD amount to Iranian Toman using live exchange rate from Nobitex API.</p>

<span id="example-requests-POSTapi-currency-convert">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/currency/convert" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"amount\": \"100\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/currency/convert"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "amount": "100"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-currency-convert">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;data&quot;: {
        &quot;usd_amount&quot;: 100,
        &quot;usd_amount_formatted&quot;: &quot;100.00&quot;,
        &quot;exchange_rate&quot;: 42000000,
        &quot;exchange_rate_formatted&quot;: &quot;42,000,000&quot;,
        &quot;irt_amount&quot;: 4200000000,
        &quot;irt_amount_formatted&quot;: &quot;4,200,000,000&quot;,
        &quot;currency&quot;: &quot;IRT&quot;,
        &quot;source&quot;: &quot;Nobitex&quot;,
        &quot;timestamp&quot;: &quot;2024-01-15T10:30:00Z&quot;,
        &quot;last_update&quot;: &quot;2024-01-15 10:25:00&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;amount&quot;: [
            &quot;The amount field is required.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Failed to fetch exchange rate from Nobitex&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-currency-convert" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-currency-convert"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-currency-convert"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-currency-convert" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-currency-convert">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-currency-convert" data-method="POST"
      data-path="api/currency/convert"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-currency-convert', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-currency-convert"
                    onclick="tryItOut('POSTapi-currency-convert');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-currency-convert"
                    onclick="cancelTryOut('POSTapi-currency-convert');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-currency-convert"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/currency/convert</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-currency-convert"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-currency-convert"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-currency-convert"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="amount"                data-endpoint="POSTapi-currency-convert"
               value="100"
               data-component="body">
    <br>
<p>USD amount to convert (must be positive). Example: <code>100</code></p>
        </div>
        </form>

                <h1 id="doctor-shifts">Doctor Shifts</h1>

    

                                <h2 id="doctor-shifts-GETapi-shifts--doctor_id-">List all shifts for a doctor</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get all scheduled shifts for a specific doctor with calculated slot information.</p>

<span id="example-requests-GETapi-shifts--doctor_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/shifts/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/shifts/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-shifts--doctor_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;shifts&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;day&quot;: 1,
            &quot;start_time&quot;: &quot;09:00&quot;,
            &quot;end_time&quot;: &quot;17:00&quot;,
            &quot;duration&quot;: 30,
            &quot;slots&quot;: 16
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Doctor not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-shifts--doctor_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-shifts--doctor_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-shifts--doctor_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-shifts--doctor_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-shifts--doctor_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-shifts--doctor_id-" data-method="GET"
      data-path="api/shifts/{doctor_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-shifts--doctor_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-shifts--doctor_id-"
                    onclick="tryItOut('GETapi-shifts--doctor_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-shifts--doctor_id-"
                    onclick="cancelTryOut('GETapi-shifts--doctor_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-shifts--doctor_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/shifts/{doctor_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-shifts--doctor_id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-shifts--doctor_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-shifts--doctor_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="GETapi-shifts--doctor_id-"
               value="1"
               data-component="url">
    <br>
<p>Doctor's ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="doctor-shifts-POSTapi-shifts">Create a new shift for a doctor</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-shifts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/shifts" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"doctor_id\": \"consequatur\",
    \"service_type\": \"doctor\",
    \"date\": \"2025-12-11\",
    \"day\": 3,
    \"is_recurring\": true,
    \"repeat_until\": \"2107-01-10\",
    \"start_time\": \"(:05\",
    \"end_time\": \"(:05\",
    \"duration\": 16,
    \"capacity_per_slot\": 6
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/shifts"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "doctor_id": "consequatur",
    "service_type": "doctor",
    "date": "2025-12-11",
    "day": 3,
    "is_recurring": true,
    "repeat_until": "2107-01-10",
    "start_time": "(:05",
    "end_time": "(:05",
    "duration": 16,
    "capacity_per_slot": 6
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-shifts">
</span>
<span id="execution-results-POSTapi-shifts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-shifts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-shifts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-shifts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-shifts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-shifts" data-method="POST"
      data-path="api/shifts"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-shifts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-shifts"
                    onclick="tryItOut('POSTapi-shifts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-shifts"
                    onclick="cancelTryOut('POSTapi-shifts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-shifts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/shifts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-shifts"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-shifts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-shifts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="POSTapi-shifts"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the doctors table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_type"                data-endpoint="POSTapi-shifts"
               value="doctor"
               data-component="body">
    <br>
<p>Example: <code>doctor</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>doctor</code></li> <li><code>injection</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="POSTapi-shifts"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Either a specific date, or a recurring weekly day must be provided. Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>day</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="day"                data-endpoint="POSTapi-shifts"
               value="3"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 6. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_recurring</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-shifts" style="display: none">
            <input type="radio" name="is_recurring"
                   value="true"
                   data-endpoint="POSTapi-shifts"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-shifts" style="display: none">
            <input type="radio" name="is_recurring"
                   value="false"
                   data-endpoint="POSTapi-shifts"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>repeat_until</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="repeat_until"                data-endpoint="POSTapi-shifts"
               value="2107-01-10"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Must be a date after or equal to <code>date</code>. Example: <code>2107-01-10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="POSTapi-shifts"
               value="(:05"
               data-component="body">
    <br>
<p>Must match the regex /^(?:[01]\d. Example: <code>(:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_time"                data-endpoint="POSTapi-shifts"
               value="(:05"
               data-component="body">
    <br>
<p>HH:MM 24h. Must match the regex /^(?:[01]\d. Example: <code>(:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duration</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="duration"                data-endpoint="POSTapi-shifts"
               value="16"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 60. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>capacity_per_slot</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="capacity_per_slot"                data-endpoint="POSTapi-shifts"
               value="6"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 100. Example: <code>6</code></p>
        </div>
        </form>

                    <h2 id="doctor-shifts-GETapi-shifts--id---day-">Show available slots for a doctor on a specific date</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get available appointment slots for a doctor on a specific date, excluding already booked slots.</p>

<span id="example-requests-GETapi-shifts--id---day-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/shifts/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/shifts/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-shifts--id---day-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;shifts&quot;: [
        {
            &quot;shift_id&quot;: 1,
            &quot;start_time&quot;: &quot;09:00&quot;,
            &quot;end_time&quot;: &quot;17:00&quot;,
            &quot;duration&quot;: 30,
            &quot;slots&quot;: [
                &quot;09:00&quot;,
                &quot;09:30&quot;,
                &quot;10:00&quot;,
                &quot;10:30&quot;
            ]
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;No shifts found for this doctor on this date.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Invalid date format.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-shifts--id---day-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-shifts--id---day-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-shifts--id---day-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-shifts--id---day-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-shifts--id---day-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-shifts--id---day-" data-method="GET"
      data-path="api/shifts/{id}/{day}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-shifts--id---day-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-shifts--id---day-"
                    onclick="tryItOut('GETapi-shifts--id---day-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-shifts--id---day-"
                    onclick="cancelTryOut('GETapi-shifts--id---day-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-shifts--id---day-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/shifts/{id}/{day}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-shifts--id---day-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-shifts--id---day-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-shifts--id---day-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-shifts--id---day-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the shift. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>day</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="day"                data-endpoint="GETapi-shifts--id---day-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="GETapi-shifts--id---day-"
               value="1"
               data-component="url">
    <br>
<p>Doctor's ID. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="GETapi-shifts--id---day-"
               value="2024-01-15"
               data-component="url">
    <br>
<p>Date in Y-m-d format. Example: <code>2024-01-15</code></p>
            </div>
                    </form>

                    <h2 id="doctor-shifts-PUTapi-shifts--id-">Update a doctor&#039;s shift</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-shifts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/shifts/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"day\": 5,
    \"start_time\": \"(:05\",
    \"end_time\": \"(:05\",
    \"duration\": 16
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/shifts/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "day": 5,
    "start_time": "(:05",
    "end_time": "(:05",
    "duration": 16
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-shifts--id-">
</span>
<span id="execution-results-PUTapi-shifts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-shifts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-shifts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-shifts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-shifts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-shifts--id-" data-method="PUT"
      data-path="api/shifts/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-shifts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-shifts--id-"
                    onclick="tryItOut('PUTapi-shifts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-shifts--id-"
                    onclick="cancelTryOut('PUTapi-shifts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-shifts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/shifts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-shifts--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-shifts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-shifts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-shifts--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the shift. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>day</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="day"                data-endpoint="PUTapi-shifts--id-"
               value="5"
               data-component="body">
    <br>
<p>Must be at least 0. Must not be greater than 6. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="PUTapi-shifts--id-"
               value="(:05"
               data-component="body">
    <br>
<p>Must match the regex /^(?:[01]\d. Example: <code>(:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_time"                data-endpoint="PUTapi-shifts--id-"
               value="(:05"
               data-component="body">
    <br>
<p>HH:MM 24h. Must match the regex /^(?:[01]\d. Example: <code>(:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duration</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="duration"                data-endpoint="PUTapi-shifts--id-"
               value="16"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 60. Example: <code>16</code></p>
        </div>
        </form>

                    <h2 id="doctor-shifts-DELETEapi-shifts--id-">Delete a doctor&#039;s shift</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-shifts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/shifts/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/shifts/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-shifts--id-">
</span>
<span id="execution-results-DELETEapi-shifts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-shifts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-shifts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-shifts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-shifts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-shifts--id-" data-method="DELETE"
      data-path="api/shifts/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-shifts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-shifts--id-"
                    onclick="tryItOut('DELETEapi-shifts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-shifts--id-"
                    onclick="cancelTryOut('DELETEapi-shifts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-shifts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/shifts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-shifts--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-shifts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-shifts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-shifts--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the shift. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="doctor-shifts-GETapi-patient-shifts--doctor_id-">List all shifts for a doctor</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get all scheduled shifts for a specific doctor with calculated slot information.</p>

<span id="example-requests-GETapi-patient-shifts--doctor_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patient/shifts/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/shifts/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patient-shifts--doctor_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;shifts&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;day&quot;: 1,
            &quot;start_time&quot;: &quot;09:00&quot;,
            &quot;end_time&quot;: &quot;17:00&quot;,
            &quot;duration&quot;: 30,
            &quot;slots&quot;: 16
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Doctor not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patient-shifts--doctor_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patient-shifts--doctor_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patient-shifts--doctor_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patient-shifts--doctor_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patient-shifts--doctor_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patient-shifts--doctor_id-" data-method="GET"
      data-path="api/patient/shifts/{doctor_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patient-shifts--doctor_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patient-shifts--doctor_id-"
                    onclick="tryItOut('GETapi-patient-shifts--doctor_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patient-shifts--doctor_id-"
                    onclick="cancelTryOut('GETapi-patient-shifts--doctor_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patient-shifts--doctor_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patient/shifts/{doctor_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patient-shifts--doctor_id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patient-shifts--doctor_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patient-shifts--doctor_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="GETapi-patient-shifts--doctor_id-"
               value="1"
               data-component="url">
    <br>
<p>Doctor's ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="doctor-shifts-GETapi-patient-shifts--id---day-">Show available slots for a doctor on a specific date</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get available appointment slots for a doctor on a specific date, excluding already booked slots.</p>

<span id="example-requests-GETapi-patient-shifts--id---day-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patient/shifts/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/shifts/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patient-shifts--id---day-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;shifts&quot;: [
        {
            &quot;shift_id&quot;: 1,
            &quot;start_time&quot;: &quot;09:00&quot;,
            &quot;end_time&quot;: &quot;17:00&quot;,
            &quot;duration&quot;: 30,
            &quot;slots&quot;: [
                &quot;09:00&quot;,
                &quot;09:30&quot;,
                &quot;10:00&quot;,
                &quot;10:30&quot;
            ]
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;No shifts found for this doctor on this date.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Invalid date format.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patient-shifts--id---day-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patient-shifts--id---day-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patient-shifts--id---day-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patient-shifts--id---day-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patient-shifts--id---day-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patient-shifts--id---day-" data-method="GET"
      data-path="api/patient/shifts/{id}/{day}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patient-shifts--id---day-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patient-shifts--id---day-"
                    onclick="tryItOut('GETapi-patient-shifts--id---day-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patient-shifts--id---day-"
                    onclick="cancelTryOut('GETapi-patient-shifts--id---day-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patient-shifts--id---day-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patient/shifts/{id}/{day}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patient-shifts--id---day-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patient-shifts--id---day-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patient-shifts--id---day-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-patient-shifts--id---day-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the shift. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>day</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="day"                data-endpoint="GETapi-patient-shifts--id---day-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="GETapi-patient-shifts--id---day-"
               value="1"
               data-component="url">
    <br>
<p>Doctor's ID. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="GETapi-patient-shifts--id---day-"
               value="2024-01-15"
               data-component="url">
    <br>
<p>Date in Y-m-d format. Example: <code>2024-01-15</code></p>
            </div>
                    </form>

                <h1 id="doctors">Doctors</h1>

    

                                <h2 id="doctors-GETapi-doctors">List all doctors</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a list of all doctors with their basic information and specialties.</p>

<span id="example-requests-GETapi-doctors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/doctors" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/doctors"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-doctors">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;doctors&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 5,
            &quot;first_name&quot;: &quot;احمد&quot;,
            &quot;last_name&quot;: &quot;محمدی&quot;,
            &quot;specialty&quot;: &quot;قلب و عروق&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-doctors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-doctors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-doctors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-doctors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-doctors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-doctors" data-method="GET"
      data-path="api/doctors"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-doctors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-doctors"
                    onclick="tryItOut('GETapi-doctors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-doctors"
                    onclick="cancelTryOut('GETapi-doctors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-doctors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/doctors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-doctors"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-doctors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-doctors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="doctors-POSTapi-doctors">Create or update a doctor</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new doctor record or update existing one. Changes user role to 'doctor'.</p>

<span id="example-requests-POSTapi-doctors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/doctors" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"user_id\": 5,
    \"specialty\": \"قلب و عروق\",
    \"code_nzam\": \"12345\",
    \"work_experience\": \"10 سال تجربه کار\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/doctors"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": 5,
    "specialty": "قلب و عروق",
    "code_nzam": "12345",
    "work_experience": "10 سال تجربه کار"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-doctors">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;User not found.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;code_nzam&quot;: [
            &quot;The code nzam has already been taken.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-doctors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-doctors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-doctors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-doctors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-doctors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-doctors" data-method="POST"
      data-path="api/doctors"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-doctors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-doctors"
                    onclick="tryItOut('POSTapi-doctors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-doctors"
                    onclick="cancelTryOut('POSTapi-doctors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-doctors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/doctors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-doctors"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-doctors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-doctors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-doctors"
               value="5"
               data-component="body">
    <br>
<p>The user's ID to make doctor. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>specialty</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="specialty"                data-endpoint="POSTapi-doctors"
               value="قلب و عروق"
               data-component="body">
    <br>
<p>Doctor's specialty. Example: <code>قلب و عروق</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code_nzam</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code_nzam"                data-endpoint="POSTapi-doctors"
               value="12345"
               data-component="body">
    <br>
<p>Medical council registration number (unique). Example: <code>12345</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>work_experience</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="work_experience"                data-endpoint="POSTapi-doctors"
               value="10 سال تجربه کار"
               data-component="body">
    <br>
<p>Doctor's work experience description. Example: <code>10 سال تجربه کار</code></p>
        </div>
        </form>

                    <h2 id="doctors-GETapi-doctors--id-">Show doctor details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-doctors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/doctors/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/doctors/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-doctors--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-doctors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-doctors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-doctors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-doctors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-doctors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-doctors--id-" data-method="GET"
      data-path="api/doctors/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-doctors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-doctors--id-"
                    onclick="tryItOut('GETapi-doctors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-doctors--id-"
                    onclick="cancelTryOut('GETapi-doctors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-doctors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/doctors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-doctors--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-doctors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-doctors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-doctors--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="doctors-PUTapi-doctors--id-">Update doctor information</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-doctors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/doctors/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"specialty\": \"vmqeopfuudtdsufvyvddq\",
    \"work_experience\": \"amniihfqcoynlazghdtqt\",
    \"phone\": \"qxbajwbpilpmufinl\",
    \"name\": \"lwloauydlsmsjuryvojcy\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/doctors/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "specialty": "vmqeopfuudtdsufvyvddq",
    "work_experience": "amniihfqcoynlazghdtqt",
    "phone": "qxbajwbpilpmufinl",
    "name": "lwloauydlsmsjuryvojcy"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-doctors--id-">
</span>
<span id="execution-results-PUTapi-doctors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-doctors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-doctors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-doctors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-doctors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-doctors--id-" data-method="PUT"
      data-path="api/doctors/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-doctors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-doctors--id-"
                    onclick="tryItOut('PUTapi-doctors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-doctors--id-"
                    onclick="cancelTryOut('PUTapi-doctors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-doctors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/doctors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-doctors--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-doctors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-doctors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-doctors--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>specialty</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="specialty"                data-endpoint="PUTapi-doctors--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code_nzam</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code_nzam"                data-endpoint="PUTapi-doctors--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>work_experience</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="work_experience"                data-endpoint="PUTapi-doctors--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="PUTapi-doctors--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-doctors--id-"
               value="qxbajwbpilpmufinl"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>qxbajwbpilpmufinl</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-doctors--id-"
               value="lwloauydlsmsjuryvojcy"
               data-component="body">
    <br>
<p>اگر میخوای شماره تلفن هم آپدیت شود. Must not be greater than 255 characters. Example: <code>lwloauydlsmsjuryvojcy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-doctors--id-"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                    <h2 id="doctors-DELETEapi-doctors--id-">Delete a doctor</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-doctors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/doctors/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/doctors/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-doctors--id-">
</span>
<span id="execution-results-DELETEapi-doctors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-doctors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-doctors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-doctors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-doctors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-doctors--id-" data-method="DELETE"
      data-path="api/doctors/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-doctors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-doctors--id-"
                    onclick="tryItOut('DELETEapi-doctors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-doctors--id-"
                    onclick="cancelTryOut('DELETEapi-doctors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-doctors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/doctors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-doctors--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-doctors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-doctors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-doctors--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="doctors-GETapi-patient-doctors">List all doctors</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a list of all doctors with their basic information and specialties.</p>

<span id="example-requests-GETapi-patient-doctors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patient/doctors" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/doctors"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patient-doctors">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;doctors&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 5,
            &quot;first_name&quot;: &quot;احمد&quot;,
            &quot;last_name&quot;: &quot;محمدی&quot;,
            &quot;specialty&quot;: &quot;قلب و عروق&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patient-doctors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patient-doctors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patient-doctors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patient-doctors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patient-doctors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patient-doctors" data-method="GET"
      data-path="api/patient/doctors"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patient-doctors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patient-doctors"
                    onclick="tryItOut('GETapi-patient-doctors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patient-doctors"
                    onclick="cancelTryOut('GETapi-patient-doctors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patient-doctors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patient/doctors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patient-doctors"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patient-doctors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patient-doctors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="doctors-GETapi-patient-doctors--id-">Show doctor details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-patient-doctors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patient/doctors/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/doctors/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patient-doctors--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patient-doctors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patient-doctors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patient-doctors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patient-doctors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patient-doctors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patient-doctors--id-" data-method="GET"
      data-path="api/patient/doctors/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patient-doctors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patient-doctors--id-"
                    onclick="tryItOut('GETapi-patient-doctors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patient-doctors--id-"
                    onclick="cancelTryOut('GETapi-patient-doctors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patient-doctors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patient/doctors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patient-doctors--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patient-doctors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patient-doctors--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-patient-doctors--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="document-records">Document Records</h1>

    

                                <h2 id="document-records-POSTapi-document-records">ذخیره پرونده اسناد</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-document-records">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/document-records" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "doctor_id=consequatur"\
    --form "patient_id=consequatur"\
    --form "title=consequatur"\
    --form "case_date=2025-12-11"\
    --form "notes=consequatur"\
    --form "files[]=@C:\Users\BARCELON\AppData\Local\Temp\phpAEDF.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/document-records"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('doctor_id', 'consequatur');
body.append('patient_id', 'consequatur');
body.append('title', 'consequatur');
body.append('case_date', '2025-12-11');
body.append('notes', 'consequatur');
body.append('files[]', document.querySelector('input[name="files[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-document-records">
</span>
<span id="execution-results-POSTapi-document-records" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-document-records"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-document-records"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-document-records" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-document-records">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-document-records" data-method="POST"
      data-path="api/document-records"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-document-records', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-document-records"
                    onclick="tryItOut('POSTapi-document-records');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-document-records"
                    onclick="cancelTryOut('POSTapi-document-records');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-document-records"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/document-records</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-document-records"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-document-records"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-document-records"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="POSTapi-document-records"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the doctors table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="POSTapi-document-records"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the patients table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-document-records"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="POSTapi-document-records"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-document-records"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>files</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="files[0]"                data-endpoint="POSTapi-document-records"
               data-component="body">
        <input type="file" style="display: none"
               name="files[1]"                data-endpoint="POSTapi-document-records"
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 20480 kilobytes.</p>
        </div>
        </form>

                    <h2 id="document-records-GETapi-document-records--doctor_id---patient_id-">دریافت پرونده‌های اسناد</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-document-records--doctor_id---patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/document-records/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/document-records/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-document-records--doctor_id---patient_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-document-records--doctor_id---patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-document-records--doctor_id---patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-document-records--doctor_id---patient_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-document-records--doctor_id---patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-document-records--doctor_id---patient_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-document-records--doctor_id---patient_id-" data-method="GET"
      data-path="api/document-records/{doctor_id}/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-document-records--doctor_id---patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-document-records--doctor_id---patient_id-"
                    onclick="tryItOut('GETapi-document-records--doctor_id---patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-document-records--doctor_id---patient_id-"
                    onclick="cancelTryOut('GETapi-document-records--doctor_id---patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-document-records--doctor_id---patient_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/document-records/{doctor_id}/{patient_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-document-records--doctor_id---patient_id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-document-records--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-document-records--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-document-records--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="GETapi-document-records--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="document-records-PUTapi-document-records--id-">بروزرسانی پرونده اسناد</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-document-records--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/document-records/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=consequatur"\
    --form "case_date=2025-12-11"\
    --form "notes=consequatur"\
    --form "files[]=@C:\Users\BARCELON\AppData\Local\Temp\phpAEE0.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/document-records/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'consequatur');
body.append('case_date', '2025-12-11');
body.append('notes', 'consequatur');
body.append('files[]', document.querySelector('input[name="files[]"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-document-records--id-">
</span>
<span id="execution-results-PUTapi-document-records--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-document-records--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-document-records--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-document-records--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-document-records--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-document-records--id-" data-method="PUT"
      data-path="api/document-records/{id}"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-document-records--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-document-records--id-"
                    onclick="tryItOut('PUTapi-document-records--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-document-records--id-"
                    onclick="cancelTryOut('PUTapi-document-records--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-document-records--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/document-records/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-document-records--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-document-records--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-document-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-document-records--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the document record. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-document-records--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="PUTapi-document-records--id-"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="PUTapi-document-records--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>files</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="files[0]"                data-endpoint="PUTapi-document-records--id-"
               data-component="body">
        <input type="file" style="display: none"
               name="files[1]"                data-endpoint="PUTapi-document-records--id-"
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 20480 kilobytes.</p>
        </div>
        </form>

                    <h2 id="document-records-DELETEapi-document-records--id-">حذف پرونده اسناد</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-document-records--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/document-records/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/document-records/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-document-records--id-">
</span>
<span id="execution-results-DELETEapi-document-records--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-document-records--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-document-records--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-document-records--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-document-records--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-document-records--id-" data-method="DELETE"
      data-path="api/document-records/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-document-records--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-document-records--id-"
                    onclick="tryItOut('DELETEapi-document-records--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-document-records--id-"
                    onclick="cancelTryOut('DELETEapi-document-records--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-document-records--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/document-records/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-document-records--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-document-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-document-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-document-records--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the document record. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-PUTapi-prescriptions--id-">PUT api/prescriptions/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-prescriptions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/prescriptions/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"medication_name\": \"consequatur\",
    \"dosage\": \"consequatur\",
    \"instructions\": \"consequatur\",
    \"duration_days\": 45
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/prescriptions/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "medication_name": "consequatur",
    "dosage": "consequatur",
    "instructions": "consequatur",
    "duration_days": 45
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-prescriptions--id-">
</span>
<span id="execution-results-PUTapi-prescriptions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-prescriptions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-prescriptions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-prescriptions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-prescriptions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-prescriptions--id-" data-method="PUT"
      data-path="api/prescriptions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-prescriptions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-prescriptions--id-"
                    onclick="tryItOut('PUTapi-prescriptions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-prescriptions--id-"
                    onclick="cancelTryOut('PUTapi-prescriptions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-prescriptions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/prescriptions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-prescriptions--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-prescriptions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-prescriptions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-prescriptions--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the prescription. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>medication_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="medication_name"                data-endpoint="PUTapi-prescriptions--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>dosage</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="dosage"                data-endpoint="PUTapi-prescriptions--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>instructions</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="instructions"                data-endpoint="PUTapi-prescriptions--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duration_days</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="duration_days"                data-endpoint="PUTapi-prescriptions--id-"
               value="45"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>45</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-prescriptions--id-">DELETE api/prescriptions/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-prescriptions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/prescriptions/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/prescriptions/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-prescriptions--id-">
</span>
<span id="execution-results-DELETEapi-prescriptions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-prescriptions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-prescriptions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-prescriptions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-prescriptions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-prescriptions--id-" data-method="DELETE"
      data-path="api/prescriptions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-prescriptions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-prescriptions--id-"
                    onclick="tryItOut('DELETEapi-prescriptions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-prescriptions--id-"
                    onclick="cancelTryOut('DELETEapi-prescriptions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-prescriptions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/prescriptions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-prescriptions--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-prescriptions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-prescriptions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-prescriptions--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the prescription. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="handwritten-records">Handwritten Records</h1>

    

                                <h2 id="handwritten-records-POSTapi-handwritten-records">ذخیره پرونده دست‌نویس</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new handwritten medical record with image/PDF files for a patient.</p>

<span id="example-requests-POSTapi-handwritten-records">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/handwritten-records" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "doctor_id=1"\
    --form "patient_id=5"\
    --form "title=نسخه دست‌نویس"\
    --form "case_date=2024-01-15"\
    --form "notes=نسخه توسط دکتر نوشته شده"\
    --form "files[]=@C:\Users\BARCELON\AppData\Local\Temp\phpAECD.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/handwritten-records"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('doctor_id', '1');
body.append('patient_id', '5');
body.append('title', 'نسخه دست‌نویس');
body.append('case_date', '2024-01-15');
body.append('notes', 'نسخه توسط دکتر نوشته شده');
body.append('files[]', document.querySelector('input[name="files[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-handwritten-records">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;handwritten_record&quot;: {
        &quot;id&quot;: 1,
        &quot;doctor_id&quot;: 1,
        &quot;patient_id&quot;: 5,
        &quot;title&quot;: &quot;نسخه دست&zwnj;نویس&quot;,
        &quot;case_medical_type_id&quot;: 2,
        &quot;case_date&quot;: &quot;2024-01-15&quot;,
        &quot;notes&quot;: &quot;نسخه توسط دکتر نوشته شده&quot;,
        &quot;files&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;file_path&quot;: &quot;case_medicals/prescription.jpg&quot;,
                &quot;file_name&quot;: &quot;prescription_handwritten.jpg&quot;,
                &quot;format&quot;: &quot;jpg&quot;,
                &quot;size&quot;: 2048000
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;دسترسی به این بیمار ندارید&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;خطا در ایجاد پرونده دست&zwnj;نویس&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-handwritten-records" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-handwritten-records"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-handwritten-records"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-handwritten-records" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-handwritten-records">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-handwritten-records" data-method="POST"
      data-path="api/handwritten-records"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-handwritten-records', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-handwritten-records"
                    onclick="tryItOut('POSTapi-handwritten-records');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-handwritten-records"
                    onclick="cancelTryOut('POSTapi-handwritten-records');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-handwritten-records"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/handwritten-records</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-handwritten-records"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-handwritten-records"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-handwritten-records"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="POSTapi-handwritten-records"
               value="1"
               data-component="body">
    <br>
<p>The doctor's ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="POSTapi-handwritten-records"
               value="5"
               data-component="body">
    <br>
<p>The patient's ID. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-handwritten-records"
               value="نسخه دست‌نویس"
               data-component="body">
    <br>
<p>Title of the handwritten record. Example: <code>نسخه دست‌نویس</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="POSTapi-handwritten-records"
               value="2024-01-15"
               data-component="body">
    <br>
<p>Date of the record (Y-m-d format). Example: <code>2024-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-handwritten-records"
               value="نسخه توسط دکتر نوشته شده"
               data-component="body">
    <br>
<p>Optional notes about the record. Example: <code>نسخه توسط دکتر نوشته شده</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>files</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="files[0]"                data-endpoint="POSTapi-handwritten-records"
               data-component="body">
        <input type="file" style="display: none"
               name="files[1]"                data-endpoint="POSTapi-handwritten-records"
               data-component="body">
    <br>
<p>Optional handwritten files (jpg,png,pdf - max 20MB each).</p>
        </div>
        </form>

                    <h2 id="handwritten-records-GETapi-handwritten-records--doctor_id---patient_id-">دریافت پرونده‌های دست‌نویس</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-handwritten-records--doctor_id---patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/handwritten-records/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/handwritten-records/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-handwritten-records--doctor_id---patient_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-handwritten-records--doctor_id---patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-handwritten-records--doctor_id---patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-handwritten-records--doctor_id---patient_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-handwritten-records--doctor_id---patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-handwritten-records--doctor_id---patient_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-handwritten-records--doctor_id---patient_id-" data-method="GET"
      data-path="api/handwritten-records/{doctor_id}/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-handwritten-records--doctor_id---patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-handwritten-records--doctor_id---patient_id-"
                    onclick="tryItOut('GETapi-handwritten-records--doctor_id---patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-handwritten-records--doctor_id---patient_id-"
                    onclick="cancelTryOut('GETapi-handwritten-records--doctor_id---patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-handwritten-records--doctor_id---patient_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/handwritten-records/{doctor_id}/{patient_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-handwritten-records--doctor_id---patient_id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-handwritten-records--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-handwritten-records--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-handwritten-records--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="GETapi-handwritten-records--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="handwritten-records-PUTapi-handwritten-records--id-">بروزرسانی پرونده دست‌نویس</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-handwritten-records--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/handwritten-records/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=consequatur"\
    --form "case_date=2025-12-11"\
    --form "notes=consequatur"\
    --form "files[]=@C:\Users\BARCELON\AppData\Local\Temp\phpAECE.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/handwritten-records/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'consequatur');
body.append('case_date', '2025-12-11');
body.append('notes', 'consequatur');
body.append('files[]', document.querySelector('input[name="files[]"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-handwritten-records--id-">
</span>
<span id="execution-results-PUTapi-handwritten-records--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-handwritten-records--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-handwritten-records--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-handwritten-records--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-handwritten-records--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-handwritten-records--id-" data-method="PUT"
      data-path="api/handwritten-records/{id}"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-handwritten-records--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-handwritten-records--id-"
                    onclick="tryItOut('PUTapi-handwritten-records--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-handwritten-records--id-"
                    onclick="cancelTryOut('PUTapi-handwritten-records--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-handwritten-records--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/handwritten-records/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-handwritten-records--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-handwritten-records--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-handwritten-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-handwritten-records--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the handwritten record. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-handwritten-records--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="PUTapi-handwritten-records--id-"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="PUTapi-handwritten-records--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>files</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="files[0]"                data-endpoint="PUTapi-handwritten-records--id-"
               data-component="body">
        <input type="file" style="display: none"
               name="files[1]"                data-endpoint="PUTapi-handwritten-records--id-"
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 20480 kilobytes.</p>
        </div>
        </form>

                    <h2 id="handwritten-records-DELETEapi-handwritten-records--id-">حذف پرونده دست‌نویس</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-handwritten-records--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/handwritten-records/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/handwritten-records/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-handwritten-records--id-">
</span>
<span id="execution-results-DELETEapi-handwritten-records--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-handwritten-records--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-handwritten-records--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-handwritten-records--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-handwritten-records--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-handwritten-records--id-" data-method="DELETE"
      data-path="api/handwritten-records/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-handwritten-records--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-handwritten-records--id-"
                    onclick="tryItOut('DELETEapi-handwritten-records--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-handwritten-records--id-"
                    onclick="cancelTryOut('DELETEapi-handwritten-records--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-handwritten-records--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/handwritten-records/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-handwritten-records--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-handwritten-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-handwritten-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-handwritten-records--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the handwritten record. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="medical-cases">Medical Cases</h1>

    

                                <h2 id="medical-cases-GETapi-medicaldocument-search">Search in medical cases</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Search through medical cases by keywords in title, notes, diagnosis, symptoms, and visit reason.
Supports additional filters for advanced search capabilities.</p>

<span id="example-requests-GETapi-medicaldocument-search">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/medicaldocument/search?q=%D8%B3%D8%B1%D8%AF%D8%B1%D8%AF&amp;doctor_id=1&amp;patient_id=5&amp;case_medical_type_id=2&amp;date_from=2024-01-01&amp;date_to=2024-12-31" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"q\": \"vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjur\",
    \"date_from\": \"2025-12-11\",
    \"date_to\": \"2025-12-11\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/medicaldocument/search"
);

const params = {
    "q": "سردرد",
    "doctor_id": "1",
    "patient_id": "5",
    "case_medical_type_id": "2",
    "date_from": "2024-01-01",
    "date_to": "2024-12-31",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "q": "vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjur",
    "date_from": "2025-12-11",
    "date_to": "2025-12-11"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-medicaldocument-search">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: &quot;success&quot;,
  &quot;search_term&quot;: &quot;سردرد&quot;,
  &quot;count&quot;: 3,
  &quot;documents&quot;: [
    {
      &quot;id&quot;: 1,
      &quot;title&quot;: &quot;شکایت از سردرد&quot;,
      &quot;case_date&quot;: &quot;2024-01-15&quot;,
      &quot;notes&quot;: &quot;بیمار از سردرد شدید شکایت دارد&quot;,
      &quot;highlighted_fields&quot;: [&quot;title&quot;, &quot;notes&quot;],
      &quot;match_count&quot;: 2,
      &quot;doctor&quot;: {...},
      &quot;patient&quot;: {...},
      &quot;visit&quot;: {...}
    }
  ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;You do not have permission to access this patient&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;q&quot;: [
            &quot;The q field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-medicaldocument-search" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-medicaldocument-search"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-medicaldocument-search"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-medicaldocument-search" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-medicaldocument-search">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-medicaldocument-search" data-method="GET"
      data-path="api/medicaldocument/search"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-medicaldocument-search', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-medicaldocument-search"
                    onclick="tryItOut('GETapi-medicaldocument-search');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-medicaldocument-search"
                    onclick="cancelTryOut('GETapi-medicaldocument-search');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-medicaldocument-search"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/medicaldocument/search</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-medicaldocument-search"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-medicaldocument-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-medicaldocument-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-medicaldocument-search"
               value="سردرد"
               data-component="query">
    <br>
<p>Search keyword (minimum 2 characters). Example: <code>سردرد</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="GETapi-medicaldocument-search"
               value="1"
               data-component="query">
    <br>
<p>Filter by doctor ID. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="GETapi-medicaldocument-search"
               value="5"
               data-component="query">
    <br>
<p>Filter by patient ID. Example: <code>5</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>case_medical_type_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="case_medical_type_id"                data-endpoint="GETapi-medicaldocument-search"
               value="2"
               data-component="query">
    <br>
<p>Filter by case type. Example: <code>2</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date_from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_from"                data-endpoint="GETapi-medicaldocument-search"
               value="2024-01-01"
               data-component="query">
    <br>
<p>Filter from date (Y-m-d format). Example: <code>2024-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date_to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_to"                data-endpoint="GETapi-medicaldocument-search"
               value="2024-12-31"
               data-component="query">
    <br>
<p>Filter to date (Y-m-d format). Example: <code>2024-12-31</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-medicaldocument-search"
               value="vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjur"
               data-component="body">
    <br>
<p>Must be at least 2 characters. Example: <code>vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-medicaldocument-search"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the doctors table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="GETapi-medicaldocument-search"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the patients table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_medical_type_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_medical_type_id"                data-endpoint="GETapi-medicaldocument-search"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the case_medical_types table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_from"                data-endpoint="GETapi-medicaldocument-search"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_to"                data-endpoint="GETapi-medicaldocument-search"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
        </form>

                    <h2 id="medical-cases-GETapi-medicaldocument-filter">Filter medical cases by doctor, patient and type</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Examples:</p>
<ul>
<li>
<p>Filter by doctor_id:
GET /api/medicaldocument/filter?doctor_id=1</p>
</li>
<li>
<p>Filter by patient_id:
GET /api/medicaldocument/filter?patient_id=5</p>
</li>
<li>
<p>Filter by case_medical_type_id:
GET /api/medicaldocument/filter?case_medical_type_id=2</p>
</li>
<li>
<p>Combined filters:
GET /api/medicaldocument/filter?doctor_id=1&amp;patient_id=5&amp;case_medical_type_id=2</p>
</li>
<li>
<p>Without filters (get all):
GET /api/medicaldocument/filter</p>
</li>
</ul>

<span id="example-requests-GETapi-medicaldocument-filter">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/medicaldocument/filter" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/medicaldocument/filter"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-medicaldocument-filter">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-medicaldocument-filter" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-medicaldocument-filter"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-medicaldocument-filter"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-medicaldocument-filter" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-medicaldocument-filter">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-medicaldocument-filter" data-method="GET"
      data-path="api/medicaldocument/filter"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-medicaldocument-filter', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-medicaldocument-filter"
                    onclick="tryItOut('GETapi-medicaldocument-filter');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-medicaldocument-filter"
                    onclick="cancelTryOut('GETapi-medicaldocument-filter');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-medicaldocument-filter"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/medicaldocument/filter</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-medicaldocument-filter"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-medicaldocument-filter"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-medicaldocument-filter"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-medicaldocument-filter"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the doctors table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="GETapi-medicaldocument-filter"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the patients table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_medical_type_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_medical_type_id"                data-endpoint="GETapi-medicaldocument-filter"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the case_medical_types table.</p>
        </div>
        </form>

                    <h2 id="medical-cases-POSTapi-medicaldocument">Create a new medical case with optional files</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new medical case record with optional file attachments for a patient.</p>

<span id="example-requests-POSTapi-medicaldocument">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/medicaldocument" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "doctor_id=1"\
    --form "patient_id=5"\
    --form "title=آزمایش خون"\
    --form "case_medical_type_id=2"\
    --form "case_date=2024-01-15"\
    --form "notes=بیمار نیاز به پیگیری دارد"\
    --form "files[]=@C:\Users\BARCELON\AppData\Local\Temp\phpAEBB.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/medicaldocument"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('doctor_id', '1');
body.append('patient_id', '5');
body.append('title', 'آزمایش خون');
body.append('case_medical_type_id', '2');
body.append('case_date', '2024-01-15');
body.append('notes', 'بیمار نیاز به پیگیری دارد');
body.append('files[]', document.querySelector('input[name="files[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-medicaldocument">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;document&quot;: {
        &quot;id&quot;: 1,
        &quot;doctor_id&quot;: 1,
        &quot;patient_id&quot;: 5,
        &quot;title&quot;: &quot;آزمایش خون&quot;,
        &quot;case_medical_type_id&quot;: 2,
        &quot;case_date&quot;: &quot;2024-01-15&quot;,
        &quot;notes&quot;: &quot;بیمار نیاز به پیگیری دارد&quot;,
        &quot;files&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;file_path&quot;: &quot;case_medicals/file1.jpg&quot;,
                &quot;file_name&quot;: &quot;test_result.jpg&quot;,
                &quot;format&quot;: &quot;jpg&quot;,
                &quot;size&quot;: 1024000
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;You do not have permission to upload documents for this patient&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;title&quot;: [
            &quot;The title field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-medicaldocument" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-medicaldocument"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-medicaldocument"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-medicaldocument" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-medicaldocument">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-medicaldocument" data-method="POST"
      data-path="api/medicaldocument"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-medicaldocument', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-medicaldocument"
                    onclick="tryItOut('POSTapi-medicaldocument');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-medicaldocument"
                    onclick="cancelTryOut('POSTapi-medicaldocument');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-medicaldocument"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/medicaldocument</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-medicaldocument"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-medicaldocument"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-medicaldocument"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="POSTapi-medicaldocument"
               value="1"
               data-component="body">
    <br>
<p>The doctor's ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="POSTapi-medicaldocument"
               value="5"
               data-component="body">
    <br>
<p>The patient's ID. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-medicaldocument"
               value="آزمایش خون"
               data-component="body">
    <br>
<p>Title of the medical case. Example: <code>آزمایش خون</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_medical_type_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="case_medical_type_id"                data-endpoint="POSTapi-medicaldocument"
               value="2"
               data-component="body">
    <br>
<p>Type of medical case. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="POSTapi-medicaldocument"
               value="2024-01-15"
               data-component="body">
    <br>
<p>Date of the case (Y-m-d format). Example: <code>2024-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-medicaldocument"
               value="بیمار نیاز به پیگیری دارد"
               data-component="body">
    <br>
<p>Optional notes about the case. Example: <code>بیمار نیاز به پیگیری دارد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>files</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="files[0]"                data-endpoint="POSTapi-medicaldocument"
               data-component="body">
        <input type="file" style="display: none"
               name="files[1]"                data-endpoint="POSTapi-medicaldocument"
               data-component="body">
    <br>
<p>Optional files (jpg,png,pdf,doc,docx - max 20MB each).</p>
        </div>
        </form>

                    <h2 id="medical-cases-GETapi-medicaldocument--doctor_id---patient_id-">List all medical cases for a doctor and patient</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-medicaldocument--doctor_id---patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/medicaldocument/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/medicaldocument/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-medicaldocument--doctor_id---patient_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-medicaldocument--doctor_id---patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-medicaldocument--doctor_id---patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-medicaldocument--doctor_id---patient_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-medicaldocument--doctor_id---patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-medicaldocument--doctor_id---patient_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-medicaldocument--doctor_id---patient_id-" data-method="GET"
      data-path="api/medicaldocument/{doctor_id}/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-medicaldocument--doctor_id---patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-medicaldocument--doctor_id---patient_id-"
                    onclick="tryItOut('GETapi-medicaldocument--doctor_id---patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-medicaldocument--doctor_id---patient_id-"
                    onclick="cancelTryOut('GETapi-medicaldocument--doctor_id---patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-medicaldocument--doctor_id---patient_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/medicaldocument/{doctor_id}/{patient_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-medicaldocument--doctor_id---patient_id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-medicaldocument--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-medicaldocument--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-medicaldocument--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="GETapi-medicaldocument--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="medical-cases-PUTapi-medicaldocument--id-">Update a medical case and optionally add files</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-medicaldocument--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/medicaldocument/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=consequatur"\
    --form "case_date=2025-12-11"\
    --form "notes=consequatur"\
    --form "files[]=@C:\Users\BARCELON\AppData\Local\Temp\phpAEBC.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/medicaldocument/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'consequatur');
body.append('case_date', '2025-12-11');
body.append('notes', 'consequatur');
body.append('files[]', document.querySelector('input[name="files[]"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-medicaldocument--id-">
</span>
<span id="execution-results-PUTapi-medicaldocument--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-medicaldocument--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-medicaldocument--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-medicaldocument--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-medicaldocument--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-medicaldocument--id-" data-method="PUT"
      data-path="api/medicaldocument/{id}"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-medicaldocument--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-medicaldocument--id-"
                    onclick="tryItOut('PUTapi-medicaldocument--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-medicaldocument--id-"
                    onclick="cancelTryOut('PUTapi-medicaldocument--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-medicaldocument--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/medicaldocument/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-medicaldocument--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-medicaldocument--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-medicaldocument--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-medicaldocument--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the medicaldocument. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-medicaldocument--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_medical_type_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_medical_type_id"                data-endpoint="PUTapi-medicaldocument--id-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the case_medical_types table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="PUTapi-medicaldocument--id-"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="PUTapi-medicaldocument--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>files</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="files[0]"                data-endpoint="PUTapi-medicaldocument--id-"
               data-component="body">
        <input type="file" style="display: none"
               name="files[1]"                data-endpoint="PUTapi-medicaldocument--id-"
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 20480 kilobytes.</p>
        </div>
        </form>

                    <h2 id="medical-cases-PATCHapi-medicaldocument-pin--id-">Toggle the pin status of a medical case</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-medicaldocument-pin--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "https://kamandi-api.test/api/medicaldocument/pin/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/medicaldocument/pin/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-medicaldocument-pin--id-">
</span>
<span id="execution-results-PATCHapi-medicaldocument-pin--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-medicaldocument-pin--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-medicaldocument-pin--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-medicaldocument-pin--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-medicaldocument-pin--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-medicaldocument-pin--id-" data-method="PATCH"
      data-path="api/medicaldocument/pin/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-medicaldocument-pin--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-medicaldocument-pin--id-"
                    onclick="tryItOut('PATCHapi-medicaldocument-pin--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-medicaldocument-pin--id-"
                    onclick="cancelTryOut('PATCHapi-medicaldocument-pin--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-medicaldocument-pin--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/medicaldocument/pin/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-medicaldocument-pin--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-medicaldocument-pin--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-medicaldocument-pin--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PATCHapi-medicaldocument-pin--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the pin. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="medical-cases-DELETEapi-medicaldocument--id-">Delete a medical case and all associated files</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-medicaldocument--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/medicaldocument/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/medicaldocument/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-medicaldocument--id-">
</span>
<span id="execution-results-DELETEapi-medicaldocument--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-medicaldocument--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-medicaldocument--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-medicaldocument--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-medicaldocument--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-medicaldocument--id-" data-method="DELETE"
      data-path="api/medicaldocument/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-medicaldocument--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-medicaldocument--id-"
                    onclick="tryItOut('DELETEapi-medicaldocument--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-medicaldocument--id-"
                    onclick="cancelTryOut('DELETEapi-medicaldocument--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-medicaldocument--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/medicaldocument/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-medicaldocument--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-medicaldocument--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-medicaldocument--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-medicaldocument--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the medicaldocument. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="medical-cases-DELETEapi-medicaldocument-file--id-">Delete a specific file from a medical case</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-medicaldocument-file--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/medicaldocument/file/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/medicaldocument/file/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-medicaldocument-file--id-">
</span>
<span id="execution-results-DELETEapi-medicaldocument-file--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-medicaldocument-file--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-medicaldocument-file--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-medicaldocument-file--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-medicaldocument-file--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-medicaldocument-file--id-" data-method="DELETE"
      data-path="api/medicaldocument/file/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-medicaldocument-file--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-medicaldocument-file--id-"
                    onclick="tryItOut('DELETEapi-medicaldocument-file--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-medicaldocument-file--id-"
                    onclick="cancelTryOut('DELETEapi-medicaldocument-file--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-medicaldocument-file--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/medicaldocument/file/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-medicaldocument-file--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-medicaldocument-file--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-medicaldocument-file--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-medicaldocument-file--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the file. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="medical-visits">Medical Visits</h1>

    

                                <h2 id="medical-visits-POSTapi-visits">Create a new medical visit</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a comprehensive visit record with case medical information and visit details.</p>

<span id="example-requests-POSTapi-visits">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/visits" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"doctor_id\": 1,
    \"patient_id\": 5,
    \"visit_date\": \"2024-01-15\",
    \"notes\": \"ویزیت عمومی\",
    \"diagnosis\": \"سرماخوردگی عادی\",
    \"follow_up_date\": \"2024-01-22\",
    \"visit_reason\": \"شکایت از تب و سردرد\",
    \"symptoms\": \"تب، سردرد، گلودرد\",
    \"prescribed_medications\": \"پاراستامول، ویتامین C\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/visits"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "doctor_id": 1,
    "patient_id": 5,
    "visit_date": "2024-01-15",
    "notes": "ویزیت عمومی",
    "diagnosis": "سرماخوردگی عادی",
    "follow_up_date": "2024-01-22",
    "visit_reason": "شکایت از تب و سردرد",
    "symptoms": "تب، سردرد، گلودرد",
    "prescribed_medications": "پاراستامول، ویتامین C"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-visits">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Visit created successfully&quot;,
    &quot;case_medical&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;گزارش ویزیت - 2024-01-15&quot;,
        &quot;case_medical_type_id&quot;: 3,
        &quot;case_date&quot;: &quot;2024-01-15&quot;,
        &quot;visit&quot;: {
            &quot;diagnosis&quot;: &quot;سرماخوردگی عادی&quot;,
            &quot;symptoms&quot;: &quot;تب، سردرد، گلودرد&quot;,
            &quot;prescribed_medications&quot;: &quot;پاراستامول، ویتامین C&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;You do not have permission to create visit for this patient&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;doctor_id&quot;: [
            &quot;The doctor id field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-visits" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-visits"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-visits"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-visits" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-visits">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-visits" data-method="POST"
      data-path="api/visits"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-visits', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-visits"
                    onclick="tryItOut('POSTapi-visits');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-visits"
                    onclick="cancelTryOut('POSTapi-visits');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-visits"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/visits</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-visits"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-visits"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-visits"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="doctor_id"                data-endpoint="POSTapi-visits"
               value="1"
               data-component="body">
    <br>
<p>Doctor's ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="POSTapi-visits"
               value="5"
               data-component="body">
    <br>
<p>Patient's ID. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visit_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="visit_date"                data-endpoint="POSTapi-visits"
               value="2024-01-15"
               data-component="body">
    <br>
<p>Visit date (Y-m-d format). Example: <code>2024-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-visits"
               value="ویزیت عمومی"
               data-component="body">
    <br>
<p>General notes about the visit. Example: <code>ویزیت عمومی</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diagnosis</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="diagnosis"                data-endpoint="POSTapi-visits"
               value="سرماخوردگی عادی"
               data-component="body">
    <br>
<p>Medical diagnosis. Example: <code>سرماخوردگی عادی</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>follow_up_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="follow_up_date"                data-endpoint="POSTapi-visits"
               value="2024-01-22"
               data-component="body">
    <br>
<p>Follow-up appointment date. Example: <code>2024-01-22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visit_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="visit_reason"                data-endpoint="POSTapi-visits"
               value="شکایت از تب و سردرد"
               data-component="body">
    <br>
<p>Reason for visit. Example: <code>شکایت از تب و سردرد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>symptoms</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="symptoms"                data-endpoint="POSTapi-visits"
               value="تب، سردرد، گلودرد"
               data-component="body">
    <br>
<p>Patient symptoms. Example: <code>تب، سردرد، گلودرد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>prescribed_medications</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="prescribed_medications"                data-endpoint="POSTapi-visits"
               value="پاراستامول، ویتامین C"
               data-component="body">
    <br>
<p>Prescribed medications. Example: <code>پاراستامول، ویتامین C</code></p>
        </div>
        </form>

                    <h2 id="medical-visits-GETapi-visits--record_id--">List medical visits</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-visits--record_id--">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/visits/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/visits/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-visits--record_id--">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-visits--record_id--" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-visits--record_id--"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-visits--record_id--"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-visits--record_id--" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-visits--record_id--">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-visits--record_id--" data-method="GET"
      data-path="api/visits/{record_id?}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-visits--record_id--', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-visits--record_id--"
                    onclick="tryItOut('GETapi-visits--record_id--');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-visits--record_id--"
                    onclick="cancelTryOut('GETapi-visits--record_id--');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-visits--record_id--"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/visits/{record_id?}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-visits--record_id--"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-visits--record_id--"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-visits--record_id--"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>record_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="record_id"                data-endpoint="GETapi-visits--record_id--"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the record. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="medical-visits-GETapi-visits--id-">Show a specific medical visit</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-visits--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/visits/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/visits/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-visits--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-visits--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-visits--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-visits--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-visits--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-visits--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-visits--id-" data-method="GET"
      data-path="api/visits/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-visits--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-visits--id-"
                    onclick="tryItOut('GETapi-visits--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-visits--id-"
                    onclick="cancelTryOut('GETapi-visits--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-visits--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/visits/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-visits--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-visits--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-visits--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-visits--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the visit. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="medical-visits-PUTapi-visits--id-">Update a medical visit</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-visits--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/visits/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"notes\": \"consequatur\",
    \"diagnosis\": \"consequatur\",
    \"follow_up_date\": \"2025-12-11\",
    \"visit_date\": \"2025-12-11\",
    \"visit_reason\": \"mqeopfuudtdsufvyvddqa\",
    \"symptoms\": \"mniihfqcoynlazghdtqtq\",
    \"prescribed_medications\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/visits/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "notes": "consequatur",
    "diagnosis": "consequatur",
    "follow_up_date": "2025-12-11",
    "visit_date": "2025-12-11",
    "visit_reason": "mqeopfuudtdsufvyvddqa",
    "symptoms": "mniihfqcoynlazghdtqtq",
    "prescribed_medications": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-visits--id-">
</span>
<span id="execution-results-PUTapi-visits--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-visits--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-visits--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-visits--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-visits--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-visits--id-" data-method="PUT"
      data-path="api/visits/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-visits--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-visits--id-"
                    onclick="tryItOut('PUTapi-visits--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-visits--id-"
                    onclick="cancelTryOut('PUTapi-visits--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-visits--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/visits/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-visits--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-visits--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-visits--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-visits--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the visit. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="PUTapi-visits--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diagnosis</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="diagnosis"                data-endpoint="PUTapi-visits--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>follow_up_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="follow_up_date"                data-endpoint="PUTapi-visits--id-"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visit_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="visit_date"                data-endpoint="PUTapi-visits--id-"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visit_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="visit_reason"                data-endpoint="PUTapi-visits--id-"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>symptoms</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="symptoms"                data-endpoint="PUTapi-visits--id-"
               value="mniihfqcoynlazghdtqtq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>mniihfqcoynlazghdtqtq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>prescribed_medications</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="prescribed_medications"                data-endpoint="PUTapi-visits--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="medical-visits-DELETEapi-visits--id-">Delete a medical visit</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-visits--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/visits/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/visits/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-visits--id-">
</span>
<span id="execution-results-DELETEapi-visits--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-visits--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-visits--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-visits--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-visits--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-visits--id-" data-method="DELETE"
      data-path="api/visits/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-visits--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-visits--id-"
                    onclick="tryItOut('DELETEapi-visits--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-visits--id-"
                    onclick="cancelTryOut('DELETEapi-visits--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-visits--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/visits/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-visits--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-visits--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-visits--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-visits--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the visit. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="patients">Patients</h1>

    

                                <h2 id="patients-GETapi-patients-search">Search patients</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Search through patients by name or national ID. Results depend on user role permissions.</p>

<span id="example-requests-GETapi-patients-search">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patients/search?q=%D8%A7%D8%AD%D9%85%D8%AF" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patients/search"
);

const params = {
    "q": "احمد",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patients-search">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;patients&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;first_name&quot;: &quot;احمد&quot;,
            &quot;last_name&quot;: &quot;محمدی&quot;,
            &quot;national_id&quot;: &quot;1234567890&quot;,
            &quot;birth_date&quot;: &quot;1990-01-15&quot;,
            &quot;gender&quot;: &quot;male&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Search query (q) is required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patients-search" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patients-search"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patients-search"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patients-search" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patients-search">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patients-search" data-method="GET"
      data-path="api/patients/search"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patients-search', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patients-search"
                    onclick="tryItOut('GETapi-patients-search');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patients-search"
                    onclick="cancelTryOut('GETapi-patients-search');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patients-search"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patients/search</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patients-search"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patients-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patients-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-patients-search"
               value="احمد"
               data-component="query">
    <br>
<p>Search query (name or national ID). Example: <code>احمد</code></p>
            </div>
                </form>

                    <h2 id="patients-GETapi-patients">List all patients with special appointments</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-patients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patients" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patients"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patients">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patients" data-method="GET"
      data-path="api/patients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patients"
                    onclick="tryItOut('GETapi-patients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patients"
                    onclick="cancelTryOut('GETapi-patients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patients"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="patients-POSTapi-patients">Create or update a patient</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new patient record or update existing one. Can link patient to current user.</p>

<span id="example-requests-POSTapi-patients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/patients" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"for\": 1,
    \"first_name\": \"احمد\",
    \"last_name\": \"محمدی\",
    \"national_id\": \"1234567890\",
    \"birth_date\": \"1990-01-15\",
    \"gender\": \"male\",
    \"blood_type\": \"A+\",
    \"allergies\": \"آلرژی به پنی‌سیلین\",
    \"chronic_diseases\": \"دیابت نوع 2\",
    \"emergency_contact\": \"09123456789\",
    \"address\": \"تهران، خیابان ولیعصر\",
    \"photo\": \"iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patients"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "for": 1,
    "first_name": "احمد",
    "last_name": "محمدی",
    "national_id": "1234567890",
    "birth_date": "1990-01-15",
    "gender": "male",
    "blood_type": "A+",
    "allergies": "آلرژی به پنی‌سیلین",
    "chronic_diseases": "دیابت نوع 2",
    "emergency_contact": "09123456789",
    "address": "تهران، خیابان ولیعصر",
    "photo": "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=="
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-patients">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;action&quot;: &quot;created&quot;,
    &quot;patient&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;احمد&quot;,
        &quot;last_name&quot;: &quot;محمدی&quot;,
        &quot;national_id&quot;: &quot;1234567890&quot;,
        &quot;birth_date&quot;: &quot;1990-01-15&quot;,
        &quot;gender&quot;: &quot;male&quot;,
        &quot;blood_type&quot;: &quot;A+&quot;,
        &quot;allergies&quot;: &quot;آلرژی به پنی&zwnj;سیلین&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;national_id&quot;: [
            &quot;The national id field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-patients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-patients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-patients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-patients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-patients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-patients" data-method="POST"
      data-path="api/patients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-patients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-patients"
                    onclick="tryItOut('POSTapi-patients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-patients"
                    onclick="cancelTryOut('POSTapi-patients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-patients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/patients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-patients"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>for</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="for"                data-endpoint="POSTapi-patients"
               value="1"
               data-component="body">
    <br>
<p>1=for self, 2=for others. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-patients"
               value="احمد"
               data-component="body">
    <br>
<p>Patient's first name. Example: <code>احمد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-patients"
               value="محمدی"
               data-component="body">
    <br>
<p>Patient's last name. Example: <code>محمدی</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="POSTapi-patients"
               value="1234567890"
               data-component="body">
    <br>
<p>National identification number. Example: <code>1234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="POSTapi-patients"
               value="1990-01-15"
               data-component="body">
    <br>
<p>Birth date (Y-m-d format). Example: <code>1990-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="POSTapi-patients"
               value="male"
               data-component="body">
    <br>
<p>Gender (male/female). Example: <code>male</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blood_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="blood_type"                data-endpoint="POSTapi-patients"
               value="A+"
               data-component="body">
    <br>
<p>Blood type. Example: <code>A+</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>allergies</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="allergies"                data-endpoint="POSTapi-patients"
               value="آلرژی به پنی‌سیلین"
               data-component="body">
    <br>
<p>Patient's allergies. Example: <code>آلرژی به پنی‌سیلین</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chronic_diseases</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="chronic_diseases"                data-endpoint="POSTapi-patients"
               value="دیابت نوع 2"
               data-component="body">
    <br>
<p>Chronic diseases. Example: <code>دیابت نوع 2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>emergency_contact</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="emergency_contact"                data-endpoint="POSTapi-patients"
               value="09123456789"
               data-component="body">
    <br>
<p>Emergency contact info. Example: <code>09123456789</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-patients"
               value="تهران، خیابان ولیعصر"
               data-component="body">
    <br>
<p>Patient's address. Example: <code>تهران، خیابان ولیعصر</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>photo</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="photo"                data-endpoint="POSTapi-patients"
               value="iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=="
               data-component="body">
    <br>
<p>Base64 encoded photo (will be resized to 48x48). Example: <code>iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==</code></p>
        </div>
        </form>

                    <h2 id="patients-GETapi-patients--id-">Show patient details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-patients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patients/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patients/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patients--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patients--id-" data-method="GET"
      data-path="api/patients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patients--id-"
                    onclick="tryItOut('GETapi-patients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patients--id-"
                    onclick="cancelTryOut('GETapi-patients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patients--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-patients--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="patients-PUTapi-patients--id-">Update patient information</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-patients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/patients/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"vmqeopfuudtdsufvyvddq\",
    \"last_name\": \"amniihfqcoynlazghdtqt\",
    \"birth_date\": \"2025-12-11T12:36:05\",
    \"gender\": \"male\",
    \"blood_type\": \"qxb\",
    \"allergies\": \"ajwbpilpmufinllwloauy\",
    \"chronic_diseases\": \"dlsmsjuryvojcybzvrbyi\",
    \"emergency_contact\": \"ckznkygloigmkwxphlvaz\",
    \"address\": \"jrcnfbaqywuxhgjjmzuxj\",
    \"photo\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patients/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "vmqeopfuudtdsufvyvddq",
    "last_name": "amniihfqcoynlazghdtqt",
    "birth_date": "2025-12-11T12:36:05",
    "gender": "male",
    "blood_type": "qxb",
    "allergies": "ajwbpilpmufinllwloauy",
    "chronic_diseases": "dlsmsjuryvojcybzvrbyi",
    "emergency_contact": "ckznkygloigmkwxphlvaz",
    "address": "jrcnfbaqywuxhgjjmzuxj",
    "photo": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-patients--id-">
</span>
<span id="execution-results-PUTapi-patients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-patients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-patients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-patients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-patients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-patients--id-" data-method="PUT"
      data-path="api/patients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-patients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-patients--id-"
                    onclick="tryItOut('PUTapi-patients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-patients--id-"
                    onclick="cancelTryOut('PUTapi-patients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-patients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/patients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-patients--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-patients--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="PUTapi-patients--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="PUTapi-patients--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="PUTapi-patients--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="PUTapi-patients--id-"
               value="2025-12-11T12:36:05"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-12-11T12:36:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="PUTapi-patients--id-"
               value="male"
               data-component="body">
    <br>
<p>Example: <code>male</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>male</code></li> <li><code>female</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blood_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="blood_type"                data-endpoint="PUTapi-patients--id-"
               value="qxb"
               data-component="body">
    <br>
<p>Must not be greater than 3 characters. Example: <code>qxb</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>allergies</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="allergies"                data-endpoint="PUTapi-patients--id-"
               value="ajwbpilpmufinllwloauy"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>ajwbpilpmufinllwloauy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chronic_diseases</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="chronic_diseases"                data-endpoint="PUTapi-patients--id-"
               value="dlsmsjuryvojcybzvrbyi"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>dlsmsjuryvojcybzvrbyi</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>emergency_contact</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="emergency_contact"                data-endpoint="PUTapi-patients--id-"
               value="ckznkygloigmkwxphlvaz"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>ckznkygloigmkwxphlvaz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-patients--id-"
               value="jrcnfbaqywuxhgjjmzuxj"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>jrcnfbaqywuxhgjjmzuxj</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>photo</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="photo"                data-endpoint="PUTapi-patients--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="patients-DELETEapi-patients--id-">Delete a patient</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-patients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/patients/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patients/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-patients--id-">
</span>
<span id="execution-results-DELETEapi-patients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-patients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-patients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-patients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-patients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-patients--id-" data-method="DELETE"
      data-path="api/patients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-patients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-patients--id-"
                    onclick="tryItOut('DELETEapi-patients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-patients--id-"
                    onclick="cancelTryOut('DELETEapi-patients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-patients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/patients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-patients--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-patients--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="patients-GETapi-patient-patients">List the logged-in user&#039;s patients</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-patient-patients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patient/patients" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/patients"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patient-patients">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patient-patients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patient-patients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patient-patients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patient-patients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patient-patients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patient-patients" data-method="GET"
      data-path="api/patient/patients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patient-patients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patient-patients"
                    onclick="tryItOut('GETapi-patient-patients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patient-patients"
                    onclick="cancelTryOut('GETapi-patient-patients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patient-patients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patient/patients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patient-patients"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patient-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patient-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="patients-POSTapi-patient-patients">Create or update a patient</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new patient record or update existing one. Can link patient to current user.</p>

<span id="example-requests-POSTapi-patient-patients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/patient/patients" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"for\": 1,
    \"first_name\": \"احمد\",
    \"last_name\": \"محمدی\",
    \"national_id\": \"1234567890\",
    \"birth_date\": \"1990-01-15\",
    \"gender\": \"male\",
    \"blood_type\": \"A+\",
    \"allergies\": \"آلرژی به پنی‌سیلین\",
    \"chronic_diseases\": \"دیابت نوع 2\",
    \"emergency_contact\": \"09123456789\",
    \"address\": \"تهران، خیابان ولیعصر\",
    \"photo\": \"iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/patients"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "for": 1,
    "first_name": "احمد",
    "last_name": "محمدی",
    "national_id": "1234567890",
    "birth_date": "1990-01-15",
    "gender": "male",
    "blood_type": "A+",
    "allergies": "آلرژی به پنی‌سیلین",
    "chronic_diseases": "دیابت نوع 2",
    "emergency_contact": "09123456789",
    "address": "تهران، خیابان ولیعصر",
    "photo": "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=="
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-patient-patients">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;action&quot;: &quot;created&quot;,
    &quot;patient&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;احمد&quot;,
        &quot;last_name&quot;: &quot;محمدی&quot;,
        &quot;national_id&quot;: &quot;1234567890&quot;,
        &quot;birth_date&quot;: &quot;1990-01-15&quot;,
        &quot;gender&quot;: &quot;male&quot;,
        &quot;blood_type&quot;: &quot;A+&quot;,
        &quot;allergies&quot;: &quot;آلرژی به پنی&zwnj;سیلین&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;national_id&quot;: [
            &quot;The national id field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-patient-patients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-patient-patients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-patient-patients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-patient-patients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-patient-patients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-patient-patients" data-method="POST"
      data-path="api/patient/patients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-patient-patients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-patient-patients"
                    onclick="tryItOut('POSTapi-patient-patients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-patient-patients"
                    onclick="cancelTryOut('POSTapi-patient-patients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-patient-patients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/patient/patients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-patient-patients"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-patient-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-patient-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>for</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="for"                data-endpoint="POSTapi-patient-patients"
               value="1"
               data-component="body">
    <br>
<p>1=for self, 2=for others. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-patient-patients"
               value="احمد"
               data-component="body">
    <br>
<p>Patient's first name. Example: <code>احمد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-patient-patients"
               value="محمدی"
               data-component="body">
    <br>
<p>Patient's last name. Example: <code>محمدی</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="POSTapi-patient-patients"
               value="1234567890"
               data-component="body">
    <br>
<p>National identification number. Example: <code>1234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="POSTapi-patient-patients"
               value="1990-01-15"
               data-component="body">
    <br>
<p>Birth date (Y-m-d format). Example: <code>1990-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="POSTapi-patient-patients"
               value="male"
               data-component="body">
    <br>
<p>Gender (male/female). Example: <code>male</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blood_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="blood_type"                data-endpoint="POSTapi-patient-patients"
               value="A+"
               data-component="body">
    <br>
<p>Blood type. Example: <code>A+</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>allergies</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="allergies"                data-endpoint="POSTapi-patient-patients"
               value="آلرژی به پنی‌سیلین"
               data-component="body">
    <br>
<p>Patient's allergies. Example: <code>آلرژی به پنی‌سیلین</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chronic_diseases</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="chronic_diseases"                data-endpoint="POSTapi-patient-patients"
               value="دیابت نوع 2"
               data-component="body">
    <br>
<p>Chronic diseases. Example: <code>دیابت نوع 2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>emergency_contact</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="emergency_contact"                data-endpoint="POSTapi-patient-patients"
               value="09123456789"
               data-component="body">
    <br>
<p>Emergency contact info. Example: <code>09123456789</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-patient-patients"
               value="تهران، خیابان ولیعصر"
               data-component="body">
    <br>
<p>Patient's address. Example: <code>تهران، خیابان ولیعصر</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>photo</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="photo"                data-endpoint="POSTapi-patient-patients"
               value="iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=="
               data-component="body">
    <br>
<p>Base64 encoded photo (will be resized to 48x48). Example: <code>iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==</code></p>
        </div>
        </form>

                    <h2 id="patients-GETapi-patient-patients--id-">Show patient details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-patient-patients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patient/patients/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/patients/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patient-patients--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patient-patients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patient-patients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patient-patients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patient-patients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patient-patients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patient-patients--id-" data-method="GET"
      data-path="api/patient/patients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patient-patients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patient-patients--id-"
                    onclick="tryItOut('GETapi-patient-patients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patient-patients--id-"
                    onclick="cancelTryOut('GETapi-patient-patients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patient-patients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patient/patients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patient-patients--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patient-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patient-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-patient-patients--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="patients-PUTapi-patient-patients--id-">Update patient information</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-patient-patients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/patient/patients/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"vmqeopfuudtdsufvyvddq\",
    \"last_name\": \"amniihfqcoynlazghdtqt\",
    \"birth_date\": \"2025-12-11T12:36:05\",
    \"gender\": \"female\",
    \"blood_type\": \"qxb\",
    \"allergies\": \"ajwbpilpmufinllwloauy\",
    \"chronic_diseases\": \"dlsmsjuryvojcybzvrbyi\",
    \"emergency_contact\": \"ckznkygloigmkwxphlvaz\",
    \"address\": \"jrcnfbaqywuxhgjjmzuxj\",
    \"photo\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/patients/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "vmqeopfuudtdsufvyvddq",
    "last_name": "amniihfqcoynlazghdtqt",
    "birth_date": "2025-12-11T12:36:05",
    "gender": "female",
    "blood_type": "qxb",
    "allergies": "ajwbpilpmufinllwloauy",
    "chronic_diseases": "dlsmsjuryvojcybzvrbyi",
    "emergency_contact": "ckznkygloigmkwxphlvaz",
    "address": "jrcnfbaqywuxhgjjmzuxj",
    "photo": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-patient-patients--id-">
</span>
<span id="execution-results-PUTapi-patient-patients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-patient-patients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-patient-patients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-patient-patients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-patient-patients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-patient-patients--id-" data-method="PUT"
      data-path="api/patient/patients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-patient-patients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-patient-patients--id-"
                    onclick="tryItOut('PUTapi-patient-patients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-patient-patients--id-"
                    onclick="cancelTryOut('PUTapi-patient-patients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-patient-patients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/patient/patients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-patient-patients--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-patient-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-patient-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-patient-patients--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="PUTapi-patient-patients--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="PUTapi-patient-patients--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="PUTapi-patient-patients--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="PUTapi-patient-patients--id-"
               value="2025-12-11T12:36:05"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-12-11T12:36:05</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="PUTapi-patient-patients--id-"
               value="female"
               data-component="body">
    <br>
<p>Example: <code>female</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>male</code></li> <li><code>female</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>blood_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="blood_type"                data-endpoint="PUTapi-patient-patients--id-"
               value="qxb"
               data-component="body">
    <br>
<p>Must not be greater than 3 characters. Example: <code>qxb</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>allergies</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="allergies"                data-endpoint="PUTapi-patient-patients--id-"
               value="ajwbpilpmufinllwloauy"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>ajwbpilpmufinllwloauy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chronic_diseases</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="chronic_diseases"                data-endpoint="PUTapi-patient-patients--id-"
               value="dlsmsjuryvojcybzvrbyi"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>dlsmsjuryvojcybzvrbyi</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>emergency_contact</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="emergency_contact"                data-endpoint="PUTapi-patient-patients--id-"
               value="ckznkygloigmkwxphlvaz"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>ckznkygloigmkwxphlvaz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-patient-patients--id-"
               value="jrcnfbaqywuxhgjjmzuxj"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>jrcnfbaqywuxhgjjmzuxj</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>photo</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="photo"                data-endpoint="PUTapi-patient-patients--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="patients-DELETEapi-patient-patients--id-">Delete a patient</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-patient-patients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/patient/patients/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/patients/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-patient-patients--id-">
</span>
<span id="execution-results-DELETEapi-patient-patients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-patient-patients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-patient-patients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-patient-patients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-patient-patients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-patient-patients--id-" data-method="DELETE"
      data-path="api/patient/patients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-patient-patients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-patient-patients--id-"
                    onclick="tryItOut('DELETEapi-patient-patients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-patient-patients--id-"
                    onclick="cancelTryOut('DELETEapi-patient-patients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-patient-patients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/patient/patients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-patient-patients--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-patient-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-patient-patients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-patient-patients--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="prescriptions">Prescriptions</h1>

    

                                <h2 id="prescriptions-POSTapi-prescriptions">Create a new prescription</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a prescription for a patient's medical record.</p>

<span id="example-requests-POSTapi-prescriptions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/prescriptions" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"medical_record_id\": 5,
    \"visit_id\": 3,
    \"medication_name\": \"آسپرین\",
    \"dosage\": \"100mg\",
    \"instructions\": \"روزی دو بار با غذا\",
    \"duration_days\": 7
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/prescriptions"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "medical_record_id": 5,
    "visit_id": 3,
    "medication_name": "آسپرین",
    "dosage": "100mg",
    "instructions": "روزی دو بار با غذا",
    "duration_days": 7
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-prescriptions">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;prescription&quot;: {
        &quot;id&quot;: 1,
        &quot;medical_record_id&quot;: 5,
        &quot;medication_name&quot;: &quot;آسپرین&quot;,
        &quot;dosage&quot;: &quot;100mg&quot;,
        &quot;instructions&quot;: &quot;روزی دو بار با غذا&quot;,
        &quot;duration_days&quot;: 7
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;medication_name&quot;: [
            &quot;The medication name field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-prescriptions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-prescriptions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-prescriptions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-prescriptions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-prescriptions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-prescriptions" data-method="POST"
      data-path="api/prescriptions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-prescriptions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-prescriptions"
                    onclick="tryItOut('POSTapi-prescriptions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-prescriptions"
                    onclick="cancelTryOut('POSTapi-prescriptions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-prescriptions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/prescriptions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-prescriptions"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-prescriptions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-prescriptions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>medical_record_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="medical_record_id"                data-endpoint="POSTapi-prescriptions"
               value="5"
               data-component="body">
    <br>
<p>Medical record ID. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visit_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="visit_id"                data-endpoint="POSTapi-prescriptions"
               value="3"
               data-component="body">
    <br>
<p>Optional visit ID. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>medication_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="medication_name"                data-endpoint="POSTapi-prescriptions"
               value="آسپرین"
               data-component="body">
    <br>
<p>Name of medication. Example: <code>آسپرین</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>dosage</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="dosage"                data-endpoint="POSTapi-prescriptions"
               value="100mg"
               data-component="body">
    <br>
<p>Medication dosage. Example: <code>100mg</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>instructions</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="instructions"                data-endpoint="POSTapi-prescriptions"
               value="روزی دو بار با غذا"
               data-component="body">
    <br>
<p>Usage instructions. Example: <code>روزی دو بار با غذا</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duration_days</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="duration_days"                data-endpoint="POSTapi-prescriptions"
               value="7"
               data-component="body">
    <br>
<p>Duration in days. Example: <code>7</code></p>
        </div>
        </form>

                    <h2 id="prescriptions-GETapi-prescriptions--record_id--">List prescriptions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get all prescriptions or filter by medical record ID.</p>

<span id="example-requests-GETapi-prescriptions--record_id--">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/prescriptions/5" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/prescriptions/5"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-prescriptions--record_id--">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;prescriptions&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;medical_record_id&quot;: 5,
            &quot;visit_id&quot;: 3,
            &quot;medication_name&quot;: &quot;آسپرین&quot;,
            &quot;dosage&quot;: &quot;100mg&quot;,
            &quot;instructions&quot;: &quot;روزی دو بار با غذا&quot;,
            &quot;duration_days&quot;: 7
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-prescriptions--record_id--" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-prescriptions--record_id--"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-prescriptions--record_id--"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-prescriptions--record_id--" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-prescriptions--record_id--">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-prescriptions--record_id--" data-method="GET"
      data-path="api/prescriptions/{record_id?}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-prescriptions--record_id--', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-prescriptions--record_id--"
                    onclick="tryItOut('GETapi-prescriptions--record_id--');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-prescriptions--record_id--"
                    onclick="cancelTryOut('GETapi-prescriptions--record_id--');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-prescriptions--record_id--"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/prescriptions/{record_id?}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-prescriptions--record_id--"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-prescriptions--record_id--"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-prescriptions--record_id--"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>record_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="record_id"                data-endpoint="GETapi-prescriptions--record_id--"
               value="5"
               data-component="url">
    <br>
<p>optional Filter by medical record ID. Example: <code>5</code></p>
            </div>
                    </form>

                    <h2 id="prescriptions-GETapi-prescriptions--id-">Show a prescription</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get details of a specific prescription by ID.</p>

<span id="example-requests-GETapi-prescriptions--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/prescriptions/1" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/prescriptions/1"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-prescriptions--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;prescription&quot;: {
        &quot;id&quot;: 1,
        &quot;medical_record_id&quot;: 5,
        &quot;medication_name&quot;: &quot;آسپرین&quot;,
        &quot;dosage&quot;: &quot;100mg&quot;,
        &quot;instructions&quot;: &quot;روزی دو بار با غذا&quot;,
        &quot;duration_days&quot;: 7
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-prescriptions--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-prescriptions--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-prescriptions--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-prescriptions--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-prescriptions--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-prescriptions--id-" data-method="GET"
      data-path="api/prescriptions/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-prescriptions--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-prescriptions--id-"
                    onclick="tryItOut('GETapi-prescriptions--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-prescriptions--id-"
                    onclick="cancelTryOut('GETapi-prescriptions--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-prescriptions--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/prescriptions/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-prescriptions--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-prescriptions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-prescriptions--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-prescriptions--id-"
               value="1"
               data-component="url">
    <br>
<p>Prescription ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="revision-logs">Revision Logs</h1>

    

                                <h2 id="revision-logs-GETapi-logs">Get all revision logs</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve all revision logs with advanced filtering and pagination options.</p>

<span id="example-requests-GETapi-logs">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/logs?user_id=1&amp;ip_address=192.168.1.1&amp;date=2024-01-15&amp;from_date=2024-01-01&amp;to_date=2024-01-31&amp;model_type=App%5C%5CModels%5C%5CUser&amp;model_id=5&amp;field=email&amp;sort_by=created_at&amp;sort_order=desc&amp;per_page=50" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/logs"
);

const params = {
    "user_id": "1",
    "ip_address": "192.168.1.1",
    "date": "2024-01-15",
    "from_date": "2024-01-01",
    "to_date": "2024-01-31",
    "model_type": "App\\Models\\User",
    "model_id": "5",
    "field": "email",
    "sort_by": "created_at",
    "sort_order": "desc",
    "per_page": "50",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-logs">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;user&quot;: {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;احمد محمدی&quot;,
                    &quot;email&quot;: &quot;ahmad@example.com&quot;
                },
                &quot;model&quot;: {
                    &quot;type&quot;: &quot;User&quot;,
                    &quot;id&quot;: 5
                },
                &quot;field&quot;: &quot;email&quot;,
                &quot;old_value&quot;: &quot;old@example.com&quot;,
                &quot;new_value&quot;: &quot;new@example.com&quot;,
                &quot;created_at&quot;: &quot;2024-01-15 10:30:00&quot;,
                &quot;created_at_human&quot;: &quot;2 hours ago&quot;
            }
        ],
        &quot;total&quot;: 100
    },
    &quot;message&quot;: &quot;لاگ&zwnj;ها با موفقیت دریافت شد&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-logs" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-logs"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-logs"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-logs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-logs">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-logs" data-method="GET"
      data-path="api/logs"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-logs', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-logs"
                    onclick="tryItOut('GETapi-logs');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-logs"
                    onclick="cancelTryOut('GETapi-logs');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-logs"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/logs</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-logs"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-logs"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-logs"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="GETapi-logs"
               value="1"
               data-component="query">
    <br>
<p>Filter by user ID. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>ip_address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ip_address"                data-endpoint="GETapi-logs"
               value="192.168.1.1"
               data-component="query">
    <br>
<p>Filter by IP address. Example: <code>192.168.1.1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="GETapi-logs"
               value="2024-01-15"
               data-component="query">
    <br>
<p>Filter by specific date (Y-m-d). Example: <code>2024-01-15</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>from_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="from_date"                data-endpoint="GETapi-logs"
               value="2024-01-01"
               data-component="query">
    <br>
<p>Filter from date (Y-m-d). Example: <code>2024-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>to_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="to_date"                data-endpoint="GETapi-logs"
               value="2024-01-31"
               data-component="query">
    <br>
<p>Filter to date (Y-m-d). Example: <code>2024-01-31</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>model_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="model_type"                data-endpoint="GETapi-logs"
               value="App\\Models\\User"
               data-component="query">
    <br>
<p>Filter by model type. Example: <code>App\\Models\\User</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>model_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="model_id"                data-endpoint="GETapi-logs"
               value="5"
               data-component="query">
    <br>
<p>Filter by model ID. Example: <code>5</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>field</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="field"                data-endpoint="GETapi-logs"
               value="email"
               data-component="query">
    <br>
<p>Filter by changed field name. Example: <code>email</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_by</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_by"                data-endpoint="GETapi-logs"
               value="created_at"
               data-component="query">
    <br>
<p>Sort field (default: created_at). Example: <code>created_at</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_order</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_order"                data-endpoint="GETapi-logs"
               value="desc"
               data-component="query">
    <br>
<p>Sort order (asc/desc, default: desc). Example: <code>desc</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-logs"
               value="50"
               data-component="query">
    <br>
<p>Items per page (default: 20). Example: <code>50</code></p>
            </div>
                </form>

                    <h2 id="revision-logs-GETapi-logs-statistics">Get revision log statistics</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get comprehensive statistics about revision activities for a specific date.</p>

<span id="example-requests-GETapi-logs-statistics">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/logs/statistics?date=2024-01-15" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/logs/statistics"
);

const params = {
    "date": "2024-01-15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-logs-statistics">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;date&quot;: &quot;2024-01-15&quot;,
        &quot;total_changes&quot;: 150,
        &quot;active_users&quot;: 12,
        &quot;changes_by_model&quot;: [
            {
                &quot;model&quot;: &quot;User&quot;,
                &quot;count&quot;: 45
            },
            {
                &quot;model&quot;: &quot;Patient&quot;,
                &quot;count&quot;: 30
            }
        ],
        &quot;changes_by_user&quot;: [
            {
                &quot;user_id&quot;: 1,
                &quot;user_name&quot;: &quot;احمد محمدی&quot;,
                &quot;user_email&quot;: &quot;ahmad@example.com&quot;,
                &quot;count&quot;: 25
            }
        ],
        &quot;most_changed_fields&quot;: [
            {
                &quot;key&quot;: &quot;email&quot;,
                &quot;count&quot;: 15
            }
        ],
        &quot;changes_by_hour&quot;: [
            {
                &quot;hour&quot;: 9,
                &quot;count&quot;: 10
            }
        ]
    },
    &quot;message&quot;: &quot;آمار با موفقیت دریافت شد&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-logs-statistics" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-logs-statistics"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-logs-statistics"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-logs-statistics" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-logs-statistics">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-logs-statistics" data-method="GET"
      data-path="api/logs/statistics"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-logs-statistics', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-logs-statistics"
                    onclick="tryItOut('GETapi-logs-statistics');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-logs-statistics"
                    onclick="cancelTryOut('GETapi-logs-statistics');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-logs-statistics"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/logs/statistics</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-logs-statistics"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-logs-statistics"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-logs-statistics"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="GETapi-logs-statistics"
               value="2024-01-15"
               data-component="query">
    <br>
<p>Target date for statistics (Y-m-d, default: today). Example: <code>2024-01-15</code></p>
            </div>
                </form>

                    <h2 id="revision-logs-GETapi-logs-recent-activity">Get recent revision activities</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-logs-recent-activity">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/logs/recent-activity" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/logs/recent-activity"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-logs-recent-activity">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-logs-recent-activity" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-logs-recent-activity"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-logs-recent-activity"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-logs-recent-activity" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-logs-recent-activity">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-logs-recent-activity" data-method="GET"
      data-path="api/logs/recent-activity"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-logs-recent-activity', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-logs-recent-activity"
                    onclick="tryItOut('GETapi-logs-recent-activity');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-logs-recent-activity"
                    onclick="cancelTryOut('GETapi-logs-recent-activity');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-logs-recent-activity"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/logs/recent-activity</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-logs-recent-activity"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-logs-recent-activity"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-logs-recent-activity"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="revision-logs-GETapi-logs-user--userId-">Get logs of a specific user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-logs-user--userId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/logs/user/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/logs/user/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-logs-user--userId-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-logs-user--userId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-logs-user--userId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-logs-user--userId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-logs-user--userId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-logs-user--userId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-logs-user--userId-" data-method="GET"
      data-path="api/logs/user/{userId}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-logs-user--userId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-logs-user--userId-"
                    onclick="tryItOut('GETapi-logs-user--userId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-logs-user--userId-"
                    onclick="cancelTryOut('GETapi-logs-user--userId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-logs-user--userId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/logs/user/{userId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-logs-user--userId-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-logs-user--userId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-logs-user--userId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>userId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="userId"                data-endpoint="GETapi-logs-user--userId-"
               value="consequatur"
               data-component="url">
    <br>
<p>Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="revision-logs-GETapi-logs-model">Get logs of a specific model</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-logs-model">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/logs/model" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"model_type\": \"consequatur\",
    \"model_id\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/logs/model"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "model_type": "consequatur",
    "model_id": 17
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-logs-model">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-logs-model" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-logs-model"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-logs-model"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-logs-model" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-logs-model">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-logs-model" data-method="GET"
      data-path="api/logs/model"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-logs-model', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-logs-model"
                    onclick="tryItOut('GETapi-logs-model');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-logs-model"
                    onclick="cancelTryOut('GETapi-logs-model');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-logs-model"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/logs/model</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-logs-model"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-logs-model"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-logs-model"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>model_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="model_type"                data-endpoint="GETapi-logs-model"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>model_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="model_id"                data-endpoint="GETapi-logs-model"
               value="17"
               data-component="body">
    <br>
<p>Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="revision-logs-GETapi-logs--id-">Show a single revision log</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-logs--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/logs/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/logs/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-logs--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-logs--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-logs--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-logs--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-logs--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-logs--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-logs--id-" data-method="GET"
      data-path="api/logs/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-logs--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-logs--id-"
                    onclick="tryItOut('GETapi-logs--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-logs--id-"
                    onclick="cancelTryOut('GETapi-logs--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-logs--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/logs/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-logs--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-logs--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-logs--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-logs--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the log. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="revision-logs-POSTapi-logs-compare">Compare two revisions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-logs-compare">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/logs/compare" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"revision_id_1\": 17,
    \"revision_id_2\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/logs/compare"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "revision_id_1": 17,
    "revision_id_2": 17
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logs-compare">
</span>
<span id="execution-results-POSTapi-logs-compare" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logs-compare"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logs-compare"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logs-compare" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logs-compare">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logs-compare" data-method="POST"
      data-path="api/logs/compare"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logs-compare', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logs-compare"
                    onclick="tryItOut('POSTapi-logs-compare');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logs-compare"
                    onclick="cancelTryOut('POSTapi-logs-compare');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logs-compare"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logs/compare</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-logs-compare"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logs-compare"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logs-compare"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>revision_id_1</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="revision_id_1"                data-endpoint="POSTapi-logs-compare"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the revisions table. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>revision_id_2</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="revision_id_2"                data-endpoint="POSTapi-logs-compare"
               value="17"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the revisions table. Example: <code>17</code></p>
        </div>
        </form>

                    <h2 id="revision-logs-DELETEapi-logs-cleanup">Delete old revision logs</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-logs-cleanup">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/logs/cleanup" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"days\": 73
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/logs/cleanup"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "days": 73
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-logs-cleanup">
</span>
<span id="execution-results-DELETEapi-logs-cleanup" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-logs-cleanup"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-logs-cleanup"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-logs-cleanup" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-logs-cleanup">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-logs-cleanup" data-method="DELETE"
      data-path="api/logs/cleanup"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-logs-cleanup', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-logs-cleanup"
                    onclick="tryItOut('DELETEapi-logs-cleanup');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-logs-cleanup"
                    onclick="cancelTryOut('DELETEapi-logs-cleanup');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-logs-cleanup"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/logs/cleanup</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-logs-cleanup"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-logs-cleanup"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-logs-cleanup"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>days</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="days"                data-endpoint="DELETEapi-logs-cleanup"
               value="73"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>73</code></p>
        </div>
        </form>

                <h1 id="text-records">Text Records</h1>

    

                                <h2 id="text-records-POSTapi-text-records">ذخیره پرونده متنی</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-text-records">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/text-records" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"doctor_id\": \"consequatur\",
    \"patient_id\": \"consequatur\",
    \"title\": \"consequatur\",
    \"case_date\": \"2025-12-11\",
    \"notes\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/text-records"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "doctor_id": "consequatur",
    "patient_id": "consequatur",
    "title": "consequatur",
    "case_date": "2025-12-11",
    "notes": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-text-records">
</span>
<span id="execution-results-POSTapi-text-records" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-text-records"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-text-records"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-text-records" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-text-records">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-text-records" data-method="POST"
      data-path="api/text-records"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-text-records', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-text-records"
                    onclick="tryItOut('POSTapi-text-records');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-text-records"
                    onclick="cancelTryOut('POSTapi-text-records');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-text-records"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/text-records</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-text-records"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-text-records"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-text-records"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="POSTapi-text-records"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the doctors table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="POSTapi-text-records"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the patients table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-text-records"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="POSTapi-text-records"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-text-records"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="text-records-GETapi-text-records--doctor_id---patient_id-">دریافت پرونده‌های متنی</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-text-records--doctor_id---patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/text-records/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/text-records/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-text-records--doctor_id---patient_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-text-records--doctor_id---patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-text-records--doctor_id---patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-text-records--doctor_id---patient_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-text-records--doctor_id---patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-text-records--doctor_id---patient_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-text-records--doctor_id---patient_id-" data-method="GET"
      data-path="api/text-records/{doctor_id}/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-text-records--doctor_id---patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-text-records--doctor_id---patient_id-"
                    onclick="tryItOut('GETapi-text-records--doctor_id---patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-text-records--doctor_id---patient_id-"
                    onclick="cancelTryOut('GETapi-text-records--doctor_id---patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-text-records--doctor_id---patient_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/text-records/{doctor_id}/{patient_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-text-records--doctor_id---patient_id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-text-records--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-text-records--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-text-records--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="GETapi-text-records--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="text-records-PUTapi-text-records--id-">بروزرسانی پرونده متنی</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-text-records--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/text-records/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"consequatur\",
    \"case_date\": \"2025-12-11\",
    \"notes\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/text-records/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "consequatur",
    "case_date": "2025-12-11",
    "notes": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-text-records--id-">
</span>
<span id="execution-results-PUTapi-text-records--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-text-records--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-text-records--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-text-records--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-text-records--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-text-records--id-" data-method="PUT"
      data-path="api/text-records/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-text-records--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-text-records--id-"
                    onclick="tryItOut('PUTapi-text-records--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-text-records--id-"
                    onclick="cancelTryOut('PUTapi-text-records--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-text-records--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/text-records/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-text-records--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-text-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-text-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-text-records--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the text record. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-text-records--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="PUTapi-text-records--id-"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="PUTapi-text-records--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="text-records-DELETEapi-text-records--id-">حذف پرونده متنی</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-text-records--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/text-records/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/text-records/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-text-records--id-">
</span>
<span id="execution-results-DELETEapi-text-records--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-text-records--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-text-records--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-text-records--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-text-records--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-text-records--id-" data-method="DELETE"
      data-path="api/text-records/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-text-records--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-text-records--id-"
                    onclick="tryItOut('DELETEapi-text-records--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-text-records--id-"
                    onclick="cancelTryOut('DELETEapi-text-records--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-text-records--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/text-records/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-text-records--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-text-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-text-records--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-text-records--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the text record. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="users">Users</h1>

    

                                <h2 id="users-GETapi-users-profile">Show the logged-in user&#039;s profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-users-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/users/profile" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/users/profile"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users-profile" data-method="GET"
      data-path="api/users/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users-profile"
                    onclick="tryItOut('GETapi-users-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users-profile"
                    onclick="cancelTryOut('GETapi-users-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-users-profile"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="users-GETapi-users">List all users</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a list of all users in the system with their basic information.</p>

<span id="example-requests-GETapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/users" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/users"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;users&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;first_name&quot;: &quot;احمد&quot;,
            &quot;last_name&quot;: &quot;محمدی&quot;,
            &quot;email&quot;: &quot;ahmad@example.com&quot;,
            &quot;mobile&quot;: &quot;09123456789&quot;,
            &quot;roll&quot;: &quot;patient&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users" data-method="GET"
      data-path="api/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users"
                    onclick="tryItOut('GETapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users"
                    onclick="cancelTryOut('GETapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-users"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="users-POSTapi-users">Create a new user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new user account with specified role and information.</p>

<span id="example-requests-POSTapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/users" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"احمد\",
    \"last_name\": \"محمدی\",
    \"gender\": \"male\",
    \"email\": \"ahmad@example.com\",
    \"password\": \"password123\",
    \"mobile\": \"09123456789\",
    \"roll\": \"patient\",
    \"national_id\": \"1234567890\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/users"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "احمد",
    "last_name": "محمدی",
    "gender": "male",
    "email": "ahmad@example.com",
    "password": "password123",
    "mobile": "09123456789",
    "roll": "patient",
    "national_id": "1234567890"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;احمد&quot;,
        &quot;last_name&quot;: &quot;محمدی&quot;,
        &quot;gender&quot;: &quot;male&quot;,
        &quot;email&quot;: &quot;ahmad@example.com&quot;,
        &quot;mobile&quot;: &quot;09123456789&quot;,
        &quot;national_id&quot;: &quot;1234567890&quot;,
        &quot;roll&quot;: &quot;patient&quot;,
        &quot;created_at&quot;: &quot;2024-01-15T10:30:00&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;errors&quot;: {
        &quot;mobile&quot;: [
            &quot;The mobile has already been taken.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users" data-method="POST"
      data-path="api/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users"
                    onclick="tryItOut('POSTapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users"
                    onclick="cancelTryOut('POSTapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-users"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-users"
               value="احمد"
               data-component="body">
    <br>
<p>User's first name. Example: <code>احمد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-users"
               value="محمدی"
               data-component="body">
    <br>
<p>User's last name. Example: <code>محمدی</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="POSTapi-users"
               value="male"
               data-component="body">
    <br>
<p>User's gender (male/female). Example: <code>male</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-users"
               value="ahmad@example.com"
               data-component="body">
    <br>
<p>User's email address (optional, must be unique). Example: <code>ahmad@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-users"
               value="password123"
               data-component="body">
    <br>
<p>User's password (minimum 6 characters). Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mobile</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mobile"                data-endpoint="POSTapi-users"
               value="09123456789"
               data-component="body">
    <br>
<p>User's mobile number (must be unique). Example: <code>09123456789</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>roll</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="roll"                data-endpoint="POSTapi-users"
               value="patient"
               data-component="body">
    <br>
<p>User's role (patient/nurse/doctor/superadmin). Example: <code>patient</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="POSTapi-users"
               value="1234567890"
               data-component="body">
    <br>
<p>National ID (must be unique). Example: <code>1234567890</code></p>
        </div>
        </form>

                    <h2 id="users-GETapi-users--id-">Show user details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/users/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/users/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users--id-" data-method="GET"
      data-path="api/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users--id-"
                    onclick="tryItOut('GETapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users--id-"
                    onclick="cancelTryOut('GETapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-users--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-users--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="users-PUTapi-users--id-">Update user information</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/users/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"vmqeopfuudtdsufvyvddq\",
    \"last_name\": \"amniihfqcoynlazghdtqt\",
    \"gender\": \"male\",
    \"roll\": \"patient\",
    \"password\": \"t(!Cs\'YAKYLk4&gt;S\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/users/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "vmqeopfuudtdsufvyvddq",
    "last_name": "amniihfqcoynlazghdtqt",
    "gender": "male",
    "roll": "patient",
    "password": "t(!Cs'YAKYLk4&gt;S"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-users--id-">
</span>
<span id="execution-results-PUTapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-users--id-" data-method="PUT"
      data-path="api/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-users--id-"
                    onclick="tryItOut('PUTapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-users--id-"
                    onclick="cancelTryOut('PUTapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-users--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-users--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="PUTapi-users--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="PUTapi-users--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="PUTapi-users--id-"
               value="male"
               data-component="body">
    <br>
<p>Example: <code>male</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>male</code></li> <li><code>female</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-users--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mobile</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mobile"                data-endpoint="PUTapi-users--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>roll</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="roll"                data-endpoint="PUTapi-users--id-"
               value="patient"
               data-component="body">
    <br>
<p>Example: <code>patient</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>patient</code></li> <li><code>nurse</code></li> <li><code>doctor</code></li> <li><code>superadmin</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="PUTapi-users--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-users--id-"
               value="t(!Cs'YAKYLk4>S"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>t(!Cs'YAKYLk4&gt;S</code></p>
        </div>
        </form>

                    <h2 id="users-DELETEapi-users--id-">Delete a user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/users/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/users/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-users--id-">
</span>
<span id="execution-results-DELETEapi-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-users--id-" data-method="DELETE"
      data-path="api/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-users--id-"
                    onclick="tryItOut('DELETEapi-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-users--id-"
                    onclick="cancelTryOut('DELETEapi-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-users--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-users--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="users-GETapi-patient-profile">Show the logged-in user&#039;s profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-patient-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/patient/profile" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/patient/profile"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patient-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patient-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patient-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patient-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patient-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patient-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patient-profile" data-method="GET"
      data-path="api/patient/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patient-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patient-profile"
                    onclick="tryItOut('GETapi-patient-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patient-profile"
                    onclick="cancelTryOut('GETapi-patient-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patient-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patient/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-patient-profile"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patient-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patient-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="visit-reports">Visit Reports</h1>

    

                                <h2 id="visit-reports-POSTapi-visit-reports">ایجاد گزارش ویزیت (CaseMedical + Visit)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-visit-reports">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://kamandi-api.test/api/visit-reports" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"doctor_id\": \"consequatur\",
    \"patient_id\": \"consequatur\",
    \"title\": \"mqeopfuudtdsufvyvddqa\",
    \"case_date\": \"2025-12-11\",
    \"notes\": \"consequatur\",
    \"visit_reason\": \"mqeopfuudtdsufvyvddqa\",
    \"symptoms\": \"mniihfqcoynlazghdtqtq\",
    \"diagnosis\": \"consequatur\",
    \"prescribed_medications\": \"consequatur\",
    \"follow_up_date\": \"2025-12-11\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/visit-reports"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "doctor_id": "consequatur",
    "patient_id": "consequatur",
    "title": "mqeopfuudtdsufvyvddqa",
    "case_date": "2025-12-11",
    "notes": "consequatur",
    "visit_reason": "mqeopfuudtdsufvyvddqa",
    "symptoms": "mniihfqcoynlazghdtqtq",
    "diagnosis": "consequatur",
    "prescribed_medications": "consequatur",
    "follow_up_date": "2025-12-11"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-visit-reports">
</span>
<span id="execution-results-POSTapi-visit-reports" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-visit-reports"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-visit-reports"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-visit-reports" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-visit-reports">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-visit-reports" data-method="POST"
      data-path="api/visit-reports"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-visit-reports', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-visit-reports"
                    onclick="tryItOut('POSTapi-visit-reports');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-visit-reports"
                    onclick="cancelTryOut('POSTapi-visit-reports');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-visit-reports"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/visit-reports</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-visit-reports"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-visit-reports"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-visit-reports"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="POSTapi-visit-reports"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the doctors table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="POSTapi-visit-reports"
               value="consequatur"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the patients table. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-visit-reports"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="POSTapi-visit-reports"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-visit-reports"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visit_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="visit_reason"                data-endpoint="POSTapi-visit-reports"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>فیلدهای Visit. Must not be greater than 255 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>symptoms</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="symptoms"                data-endpoint="POSTapi-visit-reports"
               value="mniihfqcoynlazghdtqtq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>mniihfqcoynlazghdtqtq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diagnosis</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="diagnosis"                data-endpoint="POSTapi-visit-reports"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>prescribed_medications</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="prescribed_medications"                data-endpoint="POSTapi-visit-reports"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>follow_up_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="follow_up_date"                data-endpoint="POSTapi-visit-reports"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
        </form>

                    <h2 id="visit-reports-GETapi-visit-reports--doctor_id---patient_id-">دریافت گزارش‌های ویزیت</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-visit-reports--doctor_id---patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://kamandi-api.test/api/visit-reports/consequatur/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/visit-reports/consequatur/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-visit-reports--doctor_id---patient_id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-visit-reports--doctor_id---patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-visit-reports--doctor_id---patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-visit-reports--doctor_id---patient_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-visit-reports--doctor_id---patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-visit-reports--doctor_id---patient_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-visit-reports--doctor_id---patient_id-" data-method="GET"
      data-path="api/visit-reports/{doctor_id}/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-visit-reports--doctor_id---patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-visit-reports--doctor_id---patient_id-"
                    onclick="tryItOut('GETapi-visit-reports--doctor_id---patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-visit-reports--doctor_id---patient_id-"
                    onclick="cancelTryOut('GETapi-visit-reports--doctor_id---patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-visit-reports--doctor_id---patient_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/visit-reports/{doctor_id}/{patient_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-visit-reports--doctor_id---patient_id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-visit-reports--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-visit-reports--doctor_id---patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>doctor_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="doctor_id"                data-endpoint="GETapi-visit-reports--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the doctor. Example: <code>consequatur</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="patient_id"                data-endpoint="GETapi-visit-reports--doctor_id---patient_id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="visit-reports-PUTapi-visit-reports--id-">بروزرسانی گزارش ویزیت</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-visit-reports--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://kamandi-api.test/api/visit-reports/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"vmqeopfuudtdsufvyvddq\",
    \"case_date\": \"2025-12-11\",
    \"notes\": \"consequatur\",
    \"visit_reason\": \"mqeopfuudtdsufvyvddqa\",
    \"symptoms\": \"mniihfqcoynlazghdtqtq\",
    \"diagnosis\": \"consequatur\",
    \"prescribed_medications\": \"consequatur\",
    \"follow_up_date\": \"2025-12-11\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/visit-reports/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "vmqeopfuudtdsufvyvddq",
    "case_date": "2025-12-11",
    "notes": "consequatur",
    "visit_reason": "mqeopfuudtdsufvyvddqa",
    "symptoms": "mniihfqcoynlazghdtqtq",
    "diagnosis": "consequatur",
    "prescribed_medications": "consequatur",
    "follow_up_date": "2025-12-11"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-visit-reports--id-">
</span>
<span id="execution-results-PUTapi-visit-reports--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-visit-reports--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-visit-reports--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-visit-reports--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-visit-reports--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-visit-reports--id-" data-method="PUT"
      data-path="api/visit-reports/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-visit-reports--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-visit-reports--id-"
                    onclick="tryItOut('PUTapi-visit-reports--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-visit-reports--id-"
                    onclick="cancelTryOut('PUTapi-visit-reports--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-visit-reports--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/visit-reports/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-visit-reports--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-visit-reports--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-visit-reports--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-visit-reports--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the visit report. Example: <code>consequatur</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-visit-reports--id-"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>case_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="case_date"                data-endpoint="PUTapi-visit-reports--id-"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="PUTapi-visit-reports--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visit_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="visit_reason"                data-endpoint="PUTapi-visit-reports--id-"
               value="mqeopfuudtdsufvyvddqa"
               data-component="body">
    <br>
<p>فیلدهای Visit. Must not be greater than 255 characters. Example: <code>mqeopfuudtdsufvyvddqa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>symptoms</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="symptoms"                data-endpoint="PUTapi-visit-reports--id-"
               value="mniihfqcoynlazghdtqtq"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>mniihfqcoynlazghdtqtq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diagnosis</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="diagnosis"                data-endpoint="PUTapi-visit-reports--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>prescribed_medications</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="prescribed_medications"                data-endpoint="PUTapi-visit-reports--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>follow_up_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="follow_up_date"                data-endpoint="PUTapi-visit-reports--id-"
               value="2025-12-11"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2025-12-11</code></p>
        </div>
        </form>

                    <h2 id="visit-reports-DELETEapi-visit-reports--id-">حذف گزارش ویزیت</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-visit-reports--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://kamandi-api.test/api/visit-reports/consequatur" \
    --header "Authorization: Bearer Bearer {YOUR_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://kamandi-api.test/api/visit-reports/consequatur"
);

const headers = {
    "Authorization": "Bearer Bearer {YOUR_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-visit-reports--id-">
</span>
<span id="execution-results-DELETEapi-visit-reports--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-visit-reports--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-visit-reports--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-visit-reports--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-visit-reports--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-visit-reports--id-" data-method="DELETE"
      data-path="api/visit-reports/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-visit-reports--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-visit-reports--id-"
                    onclick="tryItOut('DELETEapi-visit-reports--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-visit-reports--id-"
                    onclick="cancelTryOut('DELETEapi-visit-reports--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-visit-reports--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/visit-reports/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-visit-reports--id-"
               value="Bearer Bearer {YOUR_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer Bearer {YOUR_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-visit-reports--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-visit-reports--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-visit-reports--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the visit report. Example: <code>consequatur</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>

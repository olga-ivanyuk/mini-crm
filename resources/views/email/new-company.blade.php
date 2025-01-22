<!DOCTYPE html>
<html>
<head>
    <title>New Company Notification</title>
</head>
<body>
<h1>New Company Created</h1>
<p>A new company has been added to the system:</p>
<ul>
    <li><strong>Name:</strong> {{ $company->name }}</li>
    <li><strong>Email:</strong> {{ $company->email }}</li>
    <li><strong>Website:</strong> {{ $company->website }}</li>
</ul>
</body>
</html>


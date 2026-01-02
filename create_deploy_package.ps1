Write-Host "Starting deployment packaging..."

# Cleanup previous temp folder
if (Test-Path "deploy_temp") { 
    Write-Host "Cleaning up old temp folder..."
    Remove-Item "deploy_temp" -Recurse -Force 
}

# Create temp folder
New-Item -ItemType Directory -Path "deploy_temp" | Out-Null

# Copy Folders
$folders = @("admin", "api", "assets", "css", "includes", "js", "pages", "database")
foreach ($folder in $folders) {
    if (Test-Path $folder) {
        Write-Host "Copying $folder..."
        Copy-Item $folder -Destination "deploy_temp" -Recurse
    }
}

# Copy Files
$files = @("index.php", "migrate.php", "process_contact.php", "README.md")
foreach ($file in $files) {
    if (Test-Path $file) {
        Write-Host "Copying $file..."
        Copy-Item $file -Destination "deploy_temp"
    }
}

# Create Zip
if (Test-Path "Frequency_Lab_Deploy.zip") { 
    Write-Host "Removing old zip..."
    Remove-Item "Frequency_Lab_Deploy.zip" -Force 
}

Write-Host "Creating zip archive (this may take a moment)..."
Compress-Archive -Path "deploy_temp\*" -DestinationPath "Frequency_Lab_Deploy.zip" -Force

# Cleanup
Write-Host "Cleaning up..."
Remove-Item "deploy_temp" -Recurse -Force

Write-Host "Success! Created Frequency_Lab_Deploy.zip"

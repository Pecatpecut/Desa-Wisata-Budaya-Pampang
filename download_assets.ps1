$cssDir = ".\public\assets\css"
$fontsDir = ".\public\assets\fonts"

New-Item -ItemType Directory -Force -Path $cssDir | Out-Null
New-Item -ItemType Directory -Force -Path $fontsDir | Out-Null

Write-Host "Downloading Bootstrap CSS..." -ForegroundColor Cyan
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" `
  -OutFile "$cssDir\bootstrap.min.css"

Write-Host "Downloading Bootstrap Icons CSS..." -ForegroundColor Cyan
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" `
  -OutFile "$cssDir\bootstrap-icons.min.css"

Write-Host "Downloading Bootstrap Icons fonts..." -ForegroundColor Cyan
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/fonts/bootstrap-icons.woff2" `
  -OutFile "$fontsDir\bootstrap-icons.woff2"
Invoke-WebRequest -Uri "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/fonts/bootstrap-icons.woff" `
  -OutFile "$fontsDir\bootstrap-icons.woff"

(Get-Content "$cssDir\bootstrap-icons.min.css") `
  -replace 'url\("fonts/', 'url("../fonts/' |
  Set-Content "$cssDir\bootstrap-icons.min.css"

Write-Host "Selesai! Semua asset sudah lokal." -ForegroundColor Green

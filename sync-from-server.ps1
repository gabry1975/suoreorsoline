# Scarica dal server SiteGround le cartelle versionate nel repo.
# Uso:  .\sync-from-server.ps1
# Il tema non e' ancora definito: impostare $themeSlug quando sara' pronto.
$ErrorActionPreference = "Stop"
$hostAlias = "suoreorsoline"
$wp = "www/mindlyc38.sg-host.com/public_html/wp-content"
$themeSlug = ""
$map = @{ "mu-plugins" = "$wp/mu-plugins" }
if ($themeSlug) { $map["theme"] = "$wp/themes/$themeSlug" }
foreach ($local in $map.Keys) {
  $dest = Join-Path $PSScriptRoot $local
  Write-Host "== $local  <-  $($map[$local])"
  if (Test-Path $dest) { Get-ChildItem $dest -Force | Remove-Item -Recurse -Force }
  else { New-Item -ItemType Directory $dest | Out-Null }
  scp -r -q "${hostAlias}:$($map[$local])/." $dest
  if ($LASTEXITCODE -ne 0) { throw "Sync fallita per $local" }
}
Write-Host "Fatto. Controlla con: git status"

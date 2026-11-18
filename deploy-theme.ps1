# Carica sullo stage il tema "orsoline" (cartella theme/) e controlla la sintassi PHP sul server.
# Uso:  .\deploy-theme.ps1            (solo upload)
#       .\deploy-theme.ps1 -Activate  (upload + attivazione del tema)
param([switch]$Activate)
$ErrorActionPreference = "Stop"
$hostAlias = "suoreorsoline"
$root = "www/mindlyc38.sg-host.com/public_html"
$dest = "$root/wp-content/themes/orsoline"

ssh $hostAlias "mkdir -p $dest"
if ($LASTEXITCODE -ne 0) { throw "ssh fallito" }
scp -r -q "$PSScriptRoot\theme\." "${hostAlias}:$dest"
if ($LASTEXITCODE -ne 0) { throw "Upload del tema fallito" }

ssh $hostAlias "cd $dest && find . -name '*.php' -exec php -l {} \; | grep -v '^No syntax errors'"
if ($Activate) {
  ssh $hostAlias "cd $root && wp theme activate orsoline && wp cache flush"
  if ($LASTEXITCODE -ne 0) { throw "Attivazione del tema fallita" }
}
Write-Host "Fatto: https://mindlyc38.sg-host.com/"

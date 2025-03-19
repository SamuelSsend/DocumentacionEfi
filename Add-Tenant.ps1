param (
    [string]$tenantName,
    [string]$dbName,
    [string]$dbUser,
    [string]$ingressHost
)

function Add-Tenant {
    param (
        [string]$tenantName,
        [string]$dbName,
        [string]$dbUser,
        [string]$ingressHost
    )

    $valuesFilePath = "values.yaml"

    $tenantConfig = @"
- name: $tenantName
  mysql:
    database: ${dbName}_db
    username: $dbUser
    password: ""
    pvc:
      storage: 1Gi
  efipos:
    replicas: 1
    db:
      host: mysql
      port: 3306
      database: $dbName
      username: $dbUser
      password: ""
    ingress:
      enabled: true
      host: $ingressHost
"@

    Add-Content -Path $valuesFilePath -Value $tenantConfig

    # Aplica los cambios con Helm
    & helm upgrade efipos-chart ./efipos -f $valuesFilePath
}


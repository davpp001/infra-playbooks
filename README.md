# Infrastructure & Backup Overview

Dieses Repo enthält Ansible-Playbooks zur automatisierten Einrichtung und zum Backup einer IONOS-Server-Umgebung:

- **Phase 1**: Apache & UFW (SSH, HTTP, HTTPS)
- **Phase 2**: MySQL-Dumps → /var/backups/mysql (täglich 03:00, 14 Tage)
- **Phase 3**: IONOS-Volume-Snapshots (täglich 01:00)
- **Phase 4**: Restic-Backups → S3 (täglich 02:30, 14 daily / 4 weekly)

**Voraussetzungen**  
- Ansible & Git  
- SSH-Deploy-Key  
- Ansible-Vault für Secrets  

**Wichtige Dateien**  
- `inventory.yml`  
- `site.yml`  
- `group_vars/all/vault.yml` (verschlüsselt)  
- `docs/backup.md` (Detail-Dokumentation)  

**Restore-Schritte**  
- MySQL: `gunzip -c backup-YYYY-MM-DD.sql.gz | mysql -u root -p`  
- Restic: `restic restore latest --target /pfad`  
- Snapshots: IONOS-Portal / API  

# ResepApp

Aplikasi web resep makanan (Laravel 13 + MySQL 8.4) yang berjalan di Docker dan di-deploy ke Azure VM.

- Landing page `/` menampilkan daftar resep, pencarian nama/bahan, filter negara, form tambah, dan hapus resep.
- REST API di `/api/recipes` (GET, POST, GET/{id}, PUT/PATCH/{id}, DELETE/{id}).

## Struktur

```
resep-app/
├── Dockerfile            # multi-stage: composer -> vite build -> php:8.4-apache
├── compose.yaml          # service app + db, network internal, volume, healthcheck
├── docker/entrypoint.sh  # migrate, seed (jika kosong), cache config
├── .env.example          # contoh variabel (salin jadi .env)
├── .dockerignore
├── app/ routes/ resources/ database/ config/ ...
```

## Menjalankan (lokal maupun VM)

```bash
cp .env.example .env
# isi APP_KEY, DB_PASSWORD, dan DB_ROOT_PASSWORD di .env
echo "base64:$(openssl rand -base64 32)"     # salin hasilnya ke APP_KEY

docker compose up -d --build
docker compose ps
```

Buka `http://localhost` (lokal) atau `http://<IP_PUBLIC_VM>` (VM).

> Opsional: jalankan `npm install` sekali di lokal lalu commit `package-lock.json` agar build lebih reproducible.
> Tanpa file itu, Dockerfile otomatis memakai `npm install`.

## Deploy ke Azure VM

1. Buat VM Ubuntu 22.04/24.04. Di **Networking** buka inbound port **22** (SSH) dan **80** (HTTP). Jangan buka 3306.
2. SSH ke VM, pasang Docker:
   ```bash
   curl -fsSL https://get.docker.com | sudo sh
   sudo usermod -aG docker $USER && newgrp docker
   ```
3. Clone repo, siapkan `.env`, jalankan:
   ```bash
   git clone https://github.com/<user>/resep-app.git && cd resep-app
   cp .env.example .env && nano .env
   docker compose up -d --build
   docker compose ps
   ```
4. Akses `http://<IP_PUBLIC_VM>`.

## Perintah bukti pengujian

```bash
# 2. status service (app: running/healthy, db: healthy, db tanpa port publish)
docker compose ps

# 5. persistensi data: tambah resep di browser, lalu
docker compose down
docker compose up -d
docker compose ps      # buka lagi browser: data masih ada (volume dbdata)

# 6. keamanan network: dari luar VM (laptop) port 3306 harus gagal
nc -vz <IP_PUBLIC_VM> 3306          # atau: Test-NetConnection <IP> -Port 3306
docker compose ps                    # kolom PORTS db hanya "3306/tcp, 33060/tcp", tanpa "->"
docker network inspect resep-app_internal | grep -i internal   # "Internal": true

# 7. restart otomatis
docker stop resep-app
docker compose ps                    # app kembali "Up" beberapa detik kemudian
# atau: sudo reboot  -> setelah VM hidup lagi, docker compose ps
```

Catatan: `docker compose down` **tanpa** `-v` mempertahankan volume. Jangan pakai `down -v` saat uji persistensi.

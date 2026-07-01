from fastapi import FastAPI, status
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from typing import Optional

app = FastAPI(
    title="Motor Showroom API",
    description="Backend API untuk manajemen motor dan test drive",
    version="1.0.0"
)

# --- CORS: izinkan browser dari frontend (port 8080) fetch ke API (port 8000) ---
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],          # Untuk simulasi/dev — izinkan semua origin
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# --- SKELETON SCHEMAS (Untuk Request Body) ---
class LoginSchema(BaseModel):
    username: str
    password: str

class RegisterSchema(BaseModel):
    username: str
    email: str
    password: str

class TestDriveSchema(BaseModel):
    motor_id: int
    tanggal: str

class MotorSchema(BaseModel):
    nama: str
    merk: str
    harga: int

# --- 1. ENDPOINT AUTH ---

@app.post("/auth/login", tags=["Authentication"])
def login(payload: LoginSchema):
    """Login pengguna / admin untuk mendapatkan token."""
    return {"status": "success", "message": "Login berhasil", "token": "mock-jwt-token-here"}

@app.post("/auth/register", tags=["Authentication"])
def register(payload: RegisterSchema):
    """Daftar akun baru."""
    return {"status": "success", "message": "Registrasi berhasil"}


# --- 2. ENDPOINT MOTORS PUBLIC ---

@app.get("/motors", tags=["Motors Public"])
def get_all_motors(merk: Optional[str] = None, harga_maks: Optional[int] = None):
    """Ambil semua daftar motor (mendukung filter ?merk=... atau ?harga_maks=...)."""
    return {
        "status": "success",
        "filters_applied": {"merk": merk, "harga_maks": harga_maks},
        "data": [
            {"id": 1, "nama": "Vario 160", "merk": "Honda"},
            {"id": 2, "nama": "NMAX 155", "merk": "Yamaha"}
        ]
    }

@app.get("/motors/{id}", tags=["Motors Public"])
def get_motor_detail(id: int):
    """Ambil detail satu motor berdasarkan ID."""
    return {
        "status": "success",
        "data": {"id": id, "nama": "Vario 160", "merk": "Honda", "harga": 28000000}
    }


# --- 3. ENDPOINT TEST DRIVE ---

@app.post("/test-drive", tags=["Customer Actions"])
def request_test_drive(payload: TestDriveSchema):
    """Ajukan permohonan test drive (Memerlukan login)."""
    return {"status": "success", "message": "Permohonan test drive berhasil diajukan"}


# --- 4. ENDPOINT ADMIN ---

@app.get("/admin/motors", tags=["Admin Panel"])
def admin_get_all_motors():
    """Ambil semua motor khusus untuk panel admin."""
    return {
        "status": "success",
        "role": "admin",
        "data": [
            {"id": 1, "nama": "Vario 160", "stok": 5},
            {"id": 2, "nama": "NMAX 155", "stok": 3}
        ]
    }

@app.post("/admin/motors", tags=["Admin Panel"], status_code=status.HTTP_201_CREATED)
def admin_add_motor(payload: MotorSchema):
    """Tambah data motor baru ke database."""
    return {
        "status": "success",
        "message": "Data motor baru berhasil ditambahkan",
        "data_input": payload
    }
import os

paths = [
    r"C:\Program Files\Git\cmd\git.exe",
    r"C:\Program Files\Git\bin\git.exe",
    r"C:\Program Files (x86)\Git\cmd\git.exe",
    r"C:\Program Files (x86)\Git\bin\git.exe",
    r"C:\Users\asus\AppData\Local\Programs\Git\cmd\git.exe",
    r"C:\Users\asus\AppData\Local\Programs\Git\bin\git.exe"
]

for p in paths:
    if os.path.exists(p):
        print(f"FOUND: {p}")

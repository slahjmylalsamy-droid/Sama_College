import os

path = r"c:\xampp1\htdocs\Sama_College\index_reconstructed_all.php"
with open(path, "r", encoding="utf-8") as f:
    lines = f.readlines()

print(f"Searching for 'include' in {path}:")
for i, line in enumerate(lines):
    if "include" in line or "require" in line:
        print(f"Line {i+1}: {line.strip()}")

import os
import sys

sys.stdout.reconfigure(encoding='utf-8')

path = r"c:\xampp1\htdocs\Sama_College\index_reconstructed_all.php"
with open(path, "r", encoding="utf-8") as f:
    lines = f.readlines()

print("Reconstructed footer lines:")
for i in range(2408, 2555):
    if i < len(lines):
        line = lines[i].strip()
        if "MISSING LINE" not in line and "Tool" not in line:
            print(f"{i+1}: {line}")

import os
import time

files = [
    r"c:\xampp1\htdocs\Sama_College\index.php",
    r"c:\xampp1\htdocs\Sama_College\scratch_user_index.php",
    r"c:\xampp1\htdocs\Sama_College\index_reconstructed_all.php"
]

for f in files:
    if os.path.exists(f):
        stat = os.stat(f)
        with open(f, "r", encoding="utf-8", errors="ignore") as fh:
            lines = fh.readlines()
        print(f"File: {f}")
        print(f"  Size: {stat.st_size} bytes")
        print(f"  Lines: {len(lines)}")
        print(f"  Modified: {time.ctime(stat.st_mtime)}")
    else:
        print(f"File {f} does not exist.")

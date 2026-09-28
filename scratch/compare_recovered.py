import os
import glob
import time

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
recovered_files = glob.glob(os.path.join(scratch_dir, "git_recovered_v2_*.php"))

# Sort by name numerical order
recovered_files.sort(key=lambda x: int(os.path.basename(x).split("_")[-1].replace(".php", "")))

print(f"Total recovered files: {len(recovered_files)}")
# Let's inspect the last 5 files
for f in recovered_files[-5:]:
    stat = os.stat(f)
    with open(f, "r", encoding="utf-8", errors="ignore") as fh:
        lines = fh.readlines()
    print(f"File: {os.path.basename(f)}")
    print(f"  Size: {stat.st_size} bytes")
    print(f"  Lines: {len(lines)}")
    print(f"  Modified: {time.ctime(stat.st_mtime)}")

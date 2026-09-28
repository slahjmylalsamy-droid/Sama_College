import os

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
files = [f for f in os.listdir(scratch_dir) if f.startswith("git_recovered_") and f.endswith(".php")]

print(f"Total git_recovered files: {len(files)}")
for file in sorted(files, key=lambda x: os.path.getsize(os.path.join(scratch_dir, x))):
    path = os.path.join(scratch_dir, file)
    size = os.path.getsize(path)
    # Check if liveClock is in content
    try:
        with open(path, "r", encoding="utf-8", errors="ignore") as f:
            has_clock = "liveClock" in f.read()
    except:
        has_clock = False
    print(f"File: {file}, Size: {size}, Has liveClock: {has_clock}")

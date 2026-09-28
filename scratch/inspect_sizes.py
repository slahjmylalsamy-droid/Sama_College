import os

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
files = [f for f in os.listdir(scratch_dir) if f.startswith("git_recovered_") and f.endswith(".php")]

print(f"Total files: {len(files)}")
sizes = [os.path.getsize(os.path.join(scratch_dir, f)) for f in files]

# Print files between 100KB and 500KB
found = 0
for f in files:
    size = os.path.getsize(os.path.join(scratch_dir, f))
    if 100000 <= size <= 500000:
        found += 1
        print(f"Candidate size match: {f}, Size: {size}")

print(f"Total candidates in 100KB-500KB range: {found}")

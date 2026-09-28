import os

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
candidates = []

for file in os.listdir(scratch_dir):
    if file.startswith("git_recovered_") and file.endswith(".php"):
        path = os.path.join(scratch_dir, file)
        try:
            size = os.path.getsize(path)
            # index.php should be between 260KB and 320KB
            if 260000 <= size <= 320000:
                with open(path, "r", encoding="utf-8", errors="ignore") as f:
                    content = f.read()
                # Check for key keywords unique to index.php
                if "liveClock" in content and "layout_pages" in content and "$page_titles" in content:
                    print("Found exact index.php candidate:", path, "Size:", size)
                    candidates.append((path, size))
        except Exception as e:
            continue

print("Exact match search completed. Candidates found:", len(candidates))

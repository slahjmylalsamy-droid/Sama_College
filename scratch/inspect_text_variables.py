import os

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
files = [f for f in os.listdir(scratch_dir) if f.startswith("git_recovered_v2_") and f.endswith(".php")]

for file in files:
    path = os.path.join(scratch_dir, file)
    try:
        with open(path, "r", encoding="utf-8", errors="ignore") as f:
            content = f.read()
        
        has_layout = "layout_pages" in content
        # Check some other keywords
        has_theme = "theme" in content.lower()
        has_script = "</script>" in content
        
        # Let's see what keywords it has
        keywords = []
        if "layout_pages" in content: keywords.append("layout_pages")
        if "updateClock" in content: keywords.append("updateClock")
        if "liveClock" in content: keywords.append("liveClock")
        if "setInterval" in content: keywords.append("setInterval")
        
        print(f"File: {file}, Size: {len(content)}, Keywords: {keywords}")
    except Exception as e:
        continue

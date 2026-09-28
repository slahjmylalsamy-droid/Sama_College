import os

walkthrough_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\walkthrough.md"
if os.path.exists(walkthrough_path):
    print("Reading walkthrough.md...")
    with open(walkthrough_path, "r", encoding="utf-8", errors="ignore") as f:
        content = f.read()
    
    # Check for index.php sections
    import re
    matches = re.findall(r"index\.php", content, re.IGNORECASE)
    print("Found index.php mentions in walkthrough.md:", len(matches))
else:
    print("walkthrough.md does not exist.")

import os

walkthrough_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\walkthrough.md"
with open(walkthrough_path, "r", encoding="utf-8") as f:
    lines = f.readlines()

print(f"Total lines in walkthrough.md: {len(lines)}")
for i, line in enumerate(lines):
    if "layout_pages" in line or "updateClock" in line or "liveClock" in line:
        print(f"Line {i+1}: {line.strip()}")

import json

logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"

with open(logs_path, "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        if "index.php" in line and len(line) > 50000:
            print(f"Line {idx+1}: contains index.php and length is {len(line)}")

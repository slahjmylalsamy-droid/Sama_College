import json
import sys

sys.stdout.reconfigure(encoding='utf-8')
logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"

with open(logs_path, "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        if "major-grid" in line:
            print(f"Line {idx+1}: contains major-grid")
            # Print a snippet of where it appears
            start = line.find("major-grid")
            print(line[start:start+1000])
            print("="*40)
            break

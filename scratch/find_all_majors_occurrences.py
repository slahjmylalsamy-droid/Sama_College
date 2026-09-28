import json
import re

logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"
matches = []

with open(logs_path, "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        if "major-box" in line and len(line) < 100000:
            matches.append((idx+1, line))

print(f"Total matches containing major-box: {len(matches)}")
# Let's inspect the last match and print a good portion of it
if matches:
    last_idx, last_line = matches[-1]
    print(f"Last match at line {last_idx}:")
    obj = json.loads(last_line)
    # Search for major-box in the JSON values
    content_str = json.dumps(obj, ensure_ascii=False)
    # Find all occurrences of major-box and print context
    for m in re.finditer(r"major-box", content_str):
        start = max(0, m.start() - 100)
        end = min(len(content_str), m.end() + 300)
        print("Context:")
        print(content_str[start:end])
        print("-" * 50)

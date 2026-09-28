import json
import re
import sys

sys.stdout.reconfigure(encoding='utf-8')
logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"
found = None

with open(logs_path, "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        try:
            obj = json.loads(line)
            step_idx = obj.get("step_index", 0)
            if step_idx < 7000:
                content_str = json.dumps(obj, ensure_ascii=False)
                if "major-box" in content_str and "major_assistant" in content_str and "major_pharmacy" in content_str:
                    found = content_str
        except Exception as e:
            pass

if found:
    pos = found.find("major-grid")
    # Clean up JSON backslashes and double escapes
    sub = found[pos:pos+3000].replace("\\n", "\n").replace('\\"', '"')
    # Print up to the closing section tag
    end_pos = sub.find("</section>")
    if end_pos != -1:
        print(sub[:end_pos+10])
    else:
        print(sub[:2000])
else:
    print("No matching step found.")

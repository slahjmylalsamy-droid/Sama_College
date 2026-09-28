import json
import re

logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"
found = None

with open(logs_path, "r", encoding="utf-8") as f:
    for idx, line in enumerate(f):
        try:
            obj = json.loads(line)
            step_idx = obj.get("step_index", 0)
            if step_idx < 7000:
                # Search inside the tools or response content
                content_str = json.dumps(obj, ensure_ascii=False)
                if "major-box" in content_str and "major_assistant" in content_str and "major_pharmacy" in content_str:
                    print(f"Match found in step {step_idx}!")
                    found = content_str
                    # Break to keep the oldest or one of them
        except Exception as e:
            pass

if found:
    # Find the HTML majors grid block
    match = re.search(r"<div class=\"major-grid\".*?</div>\s*</section>", found, re.DOTALL)
    if match:
        print("Found grid block:")
        print(match.group(0))
    else:
        print("Grid block not matched via regex, printing part of found:")
        # Just find indices of major-grid and print 2000 characters
        pos = found.find("major-grid")
        print(found[pos:pos+2500])
else:
    print("No matching step found.")

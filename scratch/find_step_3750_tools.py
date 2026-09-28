import json
import sys

sys.stdout.reconfigure(encoding='utf-8')
logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"

with open(logs_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            obj = json.loads(line)
            step_idx = obj.get("step_index", 0)
            if step_idx == 3750:
                print("Step 3750 JSON:")
                # print first 3000 chars of stringified json
                s = json.dumps(obj, ensure_ascii=False)
                print(s[:4000])
                print("="*60)
        except Exception as e:
            pass

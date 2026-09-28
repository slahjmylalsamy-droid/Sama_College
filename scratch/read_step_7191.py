import json
import sys

sys.stdout.reconfigure(encoding='utf-8')
logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"

with open(logs_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            obj = json.loads(line)
            if obj.get("step_index") == 7191:
                print("Step 7191 found!")
                for tc in obj.get("tool_calls", []):
                    if tc.get("name") == "replace_file_content":
                        args = tc.get("args", {})
                        print("StartLine:", args.get("StartLine"))
                        print("EndLine:", args.get("EndLine"))
                        print("TargetContent:")
                        print(args.get("TargetContent"))
                        print("ReplacementContent:")
                        print(args.get("ReplacementContent"))
        except Exception as e:
            pass

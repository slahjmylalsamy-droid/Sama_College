import json
import sys

sys.stdout.reconfigure(encoding='utf-8')
logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"

with open(logs_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            obj = json.loads(line)
            step_idx = obj.get("step_index", 0)
            if step_idx == 4407 or step_idx == 4408 or step_idx == 4409:
                for tc in obj.get("tool_calls", []):
                    args = tc.get("args", {})
                    repl = args.get("ReplacementContent", "")
                    if "footer" in repl:
                        print(f"Step {step_idx} Replacement:")
                        print(repl)
                        print("="*60)
        except Exception as e:
            pass

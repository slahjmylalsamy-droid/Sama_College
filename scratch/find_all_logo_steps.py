import json
import sys

sys.stdout.reconfigure(encoding='utf-8')
logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"

with open(logs_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            obj = json.loads(line)
            step_idx = obj.get("step_index", 0)
            for tc in obj.get("tool_calls", []):
                args = tc.get("args", {})
                repl = args.get("ReplacementContent", "")
                if "footer-logo" in repl or "get_setting('footer_logo_size'" in repl or "footer_logo" in repl:
                    print(f"Step {step_idx} contains matching content!")
                    print("ReplacementContent snippet:")
                    pos = repl.find("footer-logo")
                    if pos == -1:
                        pos = repl.find("footer_logo")
                    print(repl[max(0, pos-200):pos+600])
                    print("="*60)
        except Exception as e:
            pass

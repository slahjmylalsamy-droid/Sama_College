import os
import json

log_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs"
transcript_path = os.path.join(log_dir, "transcript_full.jsonl")

print("Scanning early transcript history for index.php views...")

with open(transcript_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            step = json.loads(line)
            step_idx = step.get("step_index")
            if step_idx >= 4977:
                break
            
            tool_calls = step.get("tool_calls", [])
            for tc in tool_calls:
                name = tc.get("name")
                args = tc.get("args", {})
                target = args.get("TargetFile") or args.get("AbsolutePath") or ""
                if "index.php" in target and name == "view_file":
                    print(f"Step {step_idx}: View range {args.get('StartLine')} to {args.get('EndLine')}")
        except Exception as e:
            continue
print("Scan completed.")

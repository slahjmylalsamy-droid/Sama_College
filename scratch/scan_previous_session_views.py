import os
import json

transcript_path = r"C:\Users\asus\.gemini\antigravity\brain\72be6d1b-418e-468e-949c-083af82120b9\.system_generated\logs\transcript.jsonl"

print("Scanning previous session logs for index.php views...")

if os.path.exists(transcript_path):
    with open(transcript_path, "r", encoding="utf-8") as f:
        for line in f:
            try:
                step = json.loads(line)
                step_idx = step.get("step_index")
                tool_calls = step.get("tool_calls", [])
                for tc in tool_calls:
                    name = tc.get("name")
                    args = tc.get("args", {})
                    target = args.get("TargetFile") or args.get("AbsolutePath") or ""
                    if "index.php" in target and name == "view_file":
                        print(f"Step {step_idx}: View range {args.get('StartLine')} to {args.get('EndLine')}")
            except Exception as e:
                continue
else:
    print("Previous transcript does not exist.")
print("Done.")

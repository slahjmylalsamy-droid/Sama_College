import json

logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"
target_step = 7288 # The step that actually failed! Let's check step 7288 too.

with open(logs_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            obj = json.loads(line)
            step_idx = obj.get("step_index")
            if step_idx in [7191, 7220, 7256, 7288]:
                print(f"Step {step_idx} found:")
                for tc in obj.get("tool_calls", []):
                    if tc.get("name") == "replace_file_content":
                        args = tc.get("args", {})
                        print("  TargetContent length:", len(args.get("TargetContent", "")))
                        print("  ReplacementContent length:", len(args.get("ReplacementContent", "")))
                        # Let's save them to individual files
                        with open(f"scratch/step_{step_idx}_target.txt", "w", encoding="utf-8") as out:
                            out.write(args.get("TargetContent", ""))
                        with open(f"scratch/step_{step_idx}_replacement.txt", "w", encoding="utf-8") as out:
                            out.write(args.get("ReplacementContent", ""))
        except Exception as e:
            pass

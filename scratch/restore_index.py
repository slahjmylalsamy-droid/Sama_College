import os
import json

log_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs"
transcript_path = os.path.join(log_dir, "transcript_full.jsonl")

if not os.path.exists(transcript_path):
    # Try transcript.jsonl
    transcript_path = os.path.join(log_dir, "transcript.jsonl")

print("Reading transcript from:", transcript_path)

last_index_content = None

with open(transcript_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            step = json.loads(line)
            # Check tool_calls in planner response
            if step.get("type") == "PLANNER_RESPONSE":
                tool_calls = step.get("tool_calls", [])
                for tc in tool_calls:
                    if tc.get("name") in ["write_to_file", "replace_file_content", "multi_replace_file_content"]:
                        args = tc.get("args", {})
                        # Check if target file is index.php
                        target = args.get("TargetFile", "")
                        if "index.php" in target:
                            print("Found interaction with index.php in step", step.get("step_index"))
                            # If it's write_to_file, we might have full code
                            code = args.get("CodeContent")
                            if code:
                                last_index_content = code
        except Exception as e:
            continue

if last_index_content:
    print("Found complete code of index.php! Length:", len(last_index_content))
    # Write to a recovery file
    with open(r"c:\xampp1\htdocs\Sama_College\index_recovered.php", "w", encoding="utf-8") as out:
        out.write(last_index_content)
else:
    print("Could not find full index.php write_to_file in this transcript.")

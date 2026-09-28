import os
import json
import re

log_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs"
transcript_path = os.path.join(log_dir, "transcript_full.jsonl")

print("Searching transcript for index.php reads...")

with open(transcript_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            step = json.loads(line)
            step_idx = step.get("step_index")
            
            # Check system/tool responses in this step
            # Often tool output is in the step or in a nested structure
            step_str = json.dumps(step)
            if "index.php" in step_str:
                # Let's see if we have a view_file tool output
                # We can search for the line numbers or specific markers
                # For example, line 3957 or line 2920 or similar
                if "liveClock" in step_str and " canlı " not in step_str:
                    # Let's search for matches of index.php contents
                    # We can find chunks of code
                    print(f"Step {step_idx} contains index.php content with liveClock!")
                    # Let's write this step's JSON to a file for inspection
                    with open(f"c:\\xampp1\\htdocs\\Sama_College\\scratch\\step_{step_idx}.json", "w", encoding="utf-8") as out:
                        json.dump(step, out, indent=2, ensure_ascii=False)
        except Exception as e:
            continue

print("Done scanning.")

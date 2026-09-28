import json
import re

logs_path = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs\transcript_full.jsonl"

with open(logs_path, "r", encoding="utf-8") as f:
    lines = f.readlines()

print(f"Total log lines: {len(lines)}")
# Let's search backwards for the successful replaces.
for idx, line in enumerate(reversed(lines)):
    try:
        obj = json.loads(line)
        # Search for tool calls to replace_file_content or write_to_file
        if "tool_calls" in obj:
            for tc in obj["tool_calls"]:
                if tc.get("name") in ["replace_file_content", "write_to_file"]:
                    args = tc.get("args", {})
                    if "index.php" in args.get("TargetFile", ""):
                        print(f"Found match: step {obj.get('step_index')}, tool {tc.get('name')}")
                        # Print some of the content or store it
    except Exception as e:
        pass

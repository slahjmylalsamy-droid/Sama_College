import os
import json
import re

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"

if os.path.exists(scratch_dir):
    for file in os.listdir(scratch_dir):
        if file.startswith("git_recovered_v2_") and file.endswith(".php"):
            path = os.path.join(scratch_dir, file)
            try:
                with open(path, "r", encoding="utf-8", errors="ignore") as f:
                    for line in f:
                        if "index.php" in line and "Total Lines" in line:
                            try:
                                data = json.loads(line)
                                content = data.get("content", "")
                                if "Total Lines" in content:
                                    step_idx = data.get("step_index", 0)
                                    print(f"Found match in {file} at step {step_idx}!")
                                    print(f"  Content summary: {content[:300]}")
                            except Exception as json_err:
                                continue
            except Exception as e:
                continue

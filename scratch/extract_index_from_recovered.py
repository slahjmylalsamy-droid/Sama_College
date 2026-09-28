import os
import json
import re

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
best_file_content = ""
best_step_index = -1
best_line_count = 0

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
                                if "Total Lines" in content and "updateClock" in content:
                                    step_idx = data.get("step_index", 0)
                                    
                                    # Extract lines
                                    file_lines = []
                                    for l in content.split("\n"):
                                        match = re.match(r'^\s*\d+:\s*(.*)', l)
                                        if match:
                                            file_lines.append(match.group(1))
                                    
                                    line_count = len(file_lines)
                                    print(f"Found candidate in {file} at step {step_idx} with {line_count} lines.")
                                    if line_count > best_line_count:
                                        best_file_content = "\n".join(file_lines)
                                        best_step_index = step_idx
                                        best_line_count = line_count
                            except Exception as json_err:
                                continue
            except Exception as e:
                continue

if best_file_content:
    print(f"\nExtracted best index.php content from step {best_step_index}! Total lines: {best_line_count}")
    out_path = r"c:\xampp1\htdocs\Sama_College\index_recovered_from_logs.php"
    with open(out_path, "w", encoding="utf-8") as out:
        out.write(best_file_content)
    print(f"Saved to: {out_path}")
else:
    print("No complete index.php view content found in recovered files.")

import os
import json
import re

scratch_dir = r"c:\xampp1\htdocs\Sama_College\scratch"
extracted_lines = {}

# Parse all recovered v2 files
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
                                    # Extract line numbers and content
                                    for l in content.split("\n"):
                                        match = re.match(r'^\s*(\d+):\s*(.*)', l)
                                        if match:
                                            num = int(match.group(1))
                                            code = match.group(2)
                                            # We collect lines in the footer range of the 4375-line file (3800 to 4250)
                                            if 3800 <= num <= 4250:
                                                if num not in extracted_lines or len(code) > len(extracted_lines[num]):
                                                    extracted_lines[num] = code
                            except Exception as e:
                                continue
            except:
                continue

print(f"Extracted {len(extracted_lines)} unique lines in range 3800-4250.")
for num in sorted(extracted_lines.keys()):
    print(f"{num}: {extracted_lines[num]}")

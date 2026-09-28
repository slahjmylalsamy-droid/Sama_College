import os
import json
import re

log_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs"
transcript_path = os.path.join(log_dir, "transcript_full.jsonl")

# We will build a dictionary to map line numbers to their contents.
reconstructed = {}

# Regular expression to match line number formats in viewed files, e.g. "1234: some code" or " 1234:  some code"
pattern = re.compile(r'(?:^|[\s"\'`\\n]+)(\d{1,4}):\s?(.*?)(?:\\r|\\n|[\'"\s]*$)')

print("Parsing entire transcript history...")

with open(transcript_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            step = json.loads(line)
            # We look in the entire step JSON string to find line pattern matches
            step_str = json.dumps(step)
            if "index.php" in step_str:
                # Split step string by line breaks
                for part in re.split(r"\\n|\n", step_str):
                    # Clean escaping
                    part_clean = part.replace('\\"', '"').replace('\\\\', '\\')
                    # Search for line matches
                    matches = pattern.findall(part_clean)
                    for m in matches:
                        num = int(m[0])
                        code = m[1]
                        # Remove trailing JSON artifacts like \", ', etc.
                        code = re.sub(r'\\"?$', '', code)
                        # We only replace if we don't have it or if the code is longer (more complete)
                        if num not in reconstructed or len(code) > len(reconstructed[num]):
                            reconstructed[num] = code
        except Exception as e:
            continue

print("Total unique lines found:", len(reconstructed))
if reconstructed:
    sorted_lines = sorted(list(reconstructed.keys()))
    print(f"Range: {sorted_lines[0]} to {sorted_lines[-1]}")
    
    # Check for gaps
    gaps = []
    start = 1
    end = 4000
    for i in range(start, end + 1):
        if i not in reconstructed:
            if not gaps or gaps[-1][1] != i - 1:
                gaps.append([i, i])
            else:
                gaps[-1][1] = i
    print("Gaps remaining in range 1-4000:", gaps)
    
    # Save the reconstructed file
    with open(r"c:\xampp1\htdocs\Sama_College\index_reconstructed_all.php", "w", encoding="utf-8") as out:
        for i in range(1, max(sorted_lines) + 1):
            if i in reconstructed:
                out.write(reconstructed[i] + "\n")
            else:
                out.write(f"// MISSING LINE {i}\n")
    print("Saved to index_reconstructed_all.php")
else:
    print("No lines found at all!")

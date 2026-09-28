import os
import json
import re

log_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs"
transcript_path = os.path.join(log_dir, "transcript_full.jsonl")

# We want to reconstruct index.php lines 2920 to 3957.
# We will parse all lines in the transcript.
# We look for matches where "index.php" content was returned in a tool response of "view_file" or "replace_file_content".
# We extract all lines formatted like: "line_number: content" (e.g., "2925: ...") or "line_number:content".

reconstructed_lines = {}

pattern = re.compile(r"^(\d+):\s?(.*)$")

print("Parsing transcript...")

with open(transcript_path, "r", encoding="utf-8") as f:
    for line in f:
        try:
            step = json.loads(line)
            step_str = json.dumps(step)
            if "index.php" in step_str:
                # Find all line content patterns like "\n2920: " or similar
                # Let's search inside the raw string or step object
                # A robust way is to find all occurrences of "NUMBER: LINE_CONTENT" in the text
                # We can split by newline or escape sequences
                lines = re.split(r"\\n|\n", step_str)
                for l in lines:
                    # Clean up escaping if any
                    l_clean = l.replace('\\"', '"').replace('\\\\', '\\')
                    # Match pattern
                    # Check if it starts with digits followed by colon
                    # Sometimes there are leading spaces or quotes due to JSON
                    m = re.search(r'(?:^|[\s"\'`]+)(\d{3,4}):\s?(.*?)(?:\\r|\\n|[\'"\s]*$)', l_clean)
                    if m:
                        num = int(m.group(1))
                        text = m.group(2)
                        # We only care about lines 2920 to 3957
                        if 2920 <= num <= 4300:
                            reconstructed_lines[num] = text
        except Exception as e:
            continue

print("Lines found in the range 2920-4300:", len(reconstructed_lines))
sorted_nums = sorted(list(reconstructed_lines.keys()))
if sorted_nums:
    print(f"Min line: {sorted_nums[0]}, Max line: {sorted_nums[-1]}")
    # Let's check for gaps
    gaps = []
    prev = 2920
    for num in sorted_nums:
        if num > prev + 1:
            gaps.append((prev + 1, num - 1))
        prev = num
    print("Gaps:", gaps)
    
    # Save the reconstructed lines
    with open(r"c:\xampp1\htdocs\Sama_College\scratch\reconstructed_lines.json", "w", encoding="utf-8") as out:
        json.dump(reconstructed_lines, out, indent=2, ensure_ascii=False)
else:
    print("No lines found in the target range.")

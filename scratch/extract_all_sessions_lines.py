import os
import json
import re

brain_dir = r"C:\Users\asus\.gemini\antigravity\brain"
reconstructed = {}
pattern = re.compile(r'(?:^|[\s"\'`\\n]+)(\d{1,4}):\s?(.*?)(?:\\r|\\n|[\'"\s]*$)')

print("Scanning all sessions in brain folder...")

for folder in os.listdir(brain_dir):
    folder_path = os.path.join(brain_dir, folder)
    if os.path.isdir(folder_path) and folder != "tempmediaStorage":
        # Check logs directory inside session folder
        logs_dir = os.path.join(folder_path, ".system_generated", "logs")
        if os.path.exists(logs_dir):
            for file in ["transcript_full.jsonl", "transcript.jsonl"]:
                transcript_path = os.path.join(logs_dir, file)
                if os.path.exists(transcript_path):
                    print("Parsing transcript:", transcript_path)
                    try:
                        with open(transcript_path, "r", encoding="utf-8", errors="ignore") as f:
                            for line in f:
                                if "index.php" in line:
                                    try:
                                        step = json.loads(line)
                                        step_str = json.dumps(step)
                                        for part in re.split(r"\\n|\n", step_str):
                                            part_clean = part.replace('\\"', '"').replace('\\\\', '\\')
                                            matches = pattern.findall(part_clean)
                                            for m in matches:
                                                num = int(m[0])
                                                code = m[1]
                                                code = re.sub(r'\\"?$', '', code)
                                                # Overwrite only if new code is longer (more complete) or not present
                                                if num not in reconstructed or len(code) > len(reconstructed[num]):
                                                    reconstructed[num] = code
                                    except:
                                        continue
                    except Exception as e:
                        print("Error reading transcript:", e)

print("Total unique lines found across all sessions:", len(reconstructed))
if reconstructed:
    sorted_lines = sorted(list(reconstructed.keys()))
    print(f"Range: {sorted_lines[0]} to {sorted_lines[-1]}")
    
    # Check gaps
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
    print("No lines found!")

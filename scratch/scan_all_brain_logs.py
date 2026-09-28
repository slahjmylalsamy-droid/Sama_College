import os

brain_dir = r"C:\Users\asus\.gemini\antigravity\brain"
for root, dirs, files in os.walk(brain_dir):
    for file in files:
        if "transcript" in file.lower():
            path = os.path.join(root, file)
            print(f"Transcript file: {path}, Size: {os.path.getsize(path)}")

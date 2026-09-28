import os

brain_dir = r"C:\Users\asus\.gemini\antigravity\brain"
print("Scanning all files in brain directory:")

for root, dirs, files in os.walk(brain_dir):
    # Skip logs and git folder to keep output clean
    if ".system_generated" in root or ".git" in root or "tempmediaStorage" in root:
        continue
    for file in files:
        path = os.path.join(root, file)
        size = os.path.getsize(path)
        print(f"File: {path}, Size: {size}")
print("Done.")

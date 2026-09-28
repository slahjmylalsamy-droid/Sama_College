import os

brain_dir = r"C:\Users\asus\.gemini\antigravity\brain"
for folder in os.listdir(brain_dir):
    if folder != "e69fa78a-8e64-4837-8d43-af117029d7d9" and folder != "tempmediaStorage":
        folder_path = os.path.join(brain_dir, folder)
        if os.path.isdir(folder_path):
            print(f"\nFolder: {folder}")
            for root, dirs, files in os.walk(folder_path):
                if ".system_generated" in root or ".git" in root:
                    continue
                for file in files:
                    path = os.path.join(root, file)
                    print(f"  File: {file}, Size: {os.path.getsize(path)}")

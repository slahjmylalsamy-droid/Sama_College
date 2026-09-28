import os

search_folders = [
    r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\scratch",
    r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.system_generated\logs"
]

found = []

for folder in search_folders:
    if os.path.exists(folder):
        for root, dirs, files in os.walk(folder):
            for file in files:
                if file.endswith((".py", ".txt", ".jsonl", ".md")):
                    path = os.path.join(root, file)
                    try:
                        with open(path, "r", encoding="utf-8", errors="ignore") as f:
                            content = f.read()
                            if "liveClock" in content and len(content) > 10000:
                                print("Found large backup file containing liveClock:", path, "Size:", len(content))
                                found.append(path)
                    except Exception as e:
                        continue

print("Finished searching backups.")

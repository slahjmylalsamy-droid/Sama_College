import os

git_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9\.git"
logs_dir = os.path.join(git_dir, "logs", "refs")

if os.path.exists(logs_dir):
    print("Found git logs directory!")
    for root, dirs, files in os.walk(logs_dir):
        for file in files:
            path = os.path.join(root, file)
            print("Log file:", path)
            try:
                with open(path, "r", encoding="utf-8") as f:
                    print(f.read())
            except Exception as e:
                print("Error reading log:", e)
else:
    print("No git logs found.")

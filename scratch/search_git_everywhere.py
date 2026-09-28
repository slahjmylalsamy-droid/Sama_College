import os

def find_git():
    possible_dirs = [
        r"C:\Program Files",
        r"C:\Program Files (x86)",
        os.path.expanduser("~")
    ]
    for d in possible_dirs:
        for root, dirs, files in os.walk(d):
            if "git.exe" in files:
                return os.path.join(root, "git.exe")
            # Limit search depth to avoid taking too long
            if root.count(os.sep) - d.count(os.sep) > 3:
                del dirs[:] # don't go deeper
    return None

git_path = find_git()
if git_path:
    print(f"FOUND GIT AT: {git_path}")
else:
    print("Git not found in standard paths.")

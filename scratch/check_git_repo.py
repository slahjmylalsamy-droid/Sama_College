import os

workspace_dir = r"c:\xampp1\htdocs\Sama_College"
git_dir = os.path.join(workspace_dir, ".git")

if os.path.exists(git_dir):
    print(".git folder exists!")
else:
    print(".git folder does NOT exist.")

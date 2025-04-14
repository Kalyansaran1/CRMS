import os
import re

def fix_all_th_scope(directory):
    for root, _, files in os.walk(directory):
        for file in files:
            if file.endswith(".php"):
                path = os.path.join(root, file)
                with open(path, "r", encoding="utf-8") as f:
                    content = f.read()

                # Add scope="col" to <th> if it's missing
                new_content = re.sub(r'<th(?![^>]*\bscope=)([^>]*)>', r'<th scope="col"\1>', content)

                with open(path, "w", encoding="utf-8") as f:
                    f.write(new_content)

# ✅ Use raw string
fix_all_th_scope(r"C:\Users\Vyshnavi\OneDrive\Desktop\crms\crms")

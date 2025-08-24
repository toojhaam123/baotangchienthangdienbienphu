import sys
from gtts import gTTS
import os

text = sys.argv[1]
filename = sys.argv[2]
output_dir = sys.argv[3]

tts = gTTS(text=text, lang='vi', slow=False)

# Đảm bảo thư mục tồn tại
os.makedirs(output_dir, exist_ok=True)

# Lưu file mp3
tts.save(os.path.join(output_dir, filename + ".mp3"))

print("OK")

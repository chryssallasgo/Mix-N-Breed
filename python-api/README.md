\# ...existing content...



\## Python API Setup



MixNBreed uses a Python Flask API for AI-powered breed identification.



\### Prerequisites

\- Python 3.8+

\- pip



\### Setup Steps



1\. \*\*Navigate to Python API folder:\*\*

&nbsp;  ```bash

&nbsp;  cd python-api

&nbsp;  ```



2\. \*\*Create virtual environment:\*\*

&nbsp;  ```bash

&nbsp;  python -m venv venv

&nbsp;  venv\\Scripts\\activate  # Windows

&nbsp;  source venv/bin/activate  # Mac/Linux

&nbsp;  ```



3\. \*\*Install dependencies:\*\*

&nbsp;  ```bash

&nbsp;  pip install -r requirements.txt

&nbsp;  ```



4\. \*\*Start the API:\*\*

&nbsp;  ```bash

&nbsp;  python app.py

&nbsp;  ```



5\. \*\*Update Laravel `.env`:\*\*

&nbsp;  ```env

&nbsp;  BREED\_IDENTIFICATION\_API\_URL=http://localhost:5001

&nbsp;  ```



The API will run on `http://localhost:5001`. See `python-api/README.md` for more details.


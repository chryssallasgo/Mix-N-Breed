from flask import Flask, request, jsonify
from flask_cors import CORS
import tensorflow as tf
from tensorflow.keras.preprocessing import image
import numpy as np
import os
from werkzeug.utils import secure_filename
import base64
from io import BytesIO
from PIL import Image

app = Flask(__name__)
CORS(app)  # Allow Laravel to call this API

# Configuration
MODEL_PATH = 'models/dog_breed_classifier.keras'
CLASS_NAMES_PATH = 'models/class_names.txt'
IMAGE_SIZE = (224, 224)
UPLOAD_FOLDER = 'temp_uploads'
ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg'}

# Create upload folder if it doesn't exist
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

# Load model and class names at startup
print("Loading model...")
model = tf.keras.models.load_model(MODEL_PATH)

class_names = []
with open(CLASS_NAMES_PATH, 'r') as f:
    class_names = [line.strip() for line in f]

print(f"Model loaded! Can identify {len(class_names)} dog breeds.")


def allowed_file(filename):
    """Check if file extension is allowed"""
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS


def preprocess_image(img_path):
    """Load and preprocess image for prediction"""
    img = image.load_img(img_path, target_size=IMAGE_SIZE)
    img_array = image.img_to_array(img)
    img_array = np.expand_dims(img_array, axis=0)
    img_array = img_array / 255.0
    return img_array


@app.route('/health', methods=['GET'])
def health_check():
    """Simple health check endpoint"""
    return jsonify({
        'status': 'ok',
        'model_loaded': model is not None,
        'breeds_count': len(class_names)
    })


@app.route('/identify', methods=['POST'])
def identify_breed():
    """
    Identify dog breed from uploaded image
    Accepts: multipart/form-data with 'image' file
    Returns: JSON with breed name, confidence, and all predictions
    """
    try:
        # Check if image file is present
        if 'image' not in request.files:
            return jsonify({'error': 'No image file provided'}), 400
        
        file = request.files['image']
        
        if file.filename == '':
            return jsonify({'error': 'No file selected'}), 400
        
        if not allowed_file(file.filename):
            return jsonify({'error': 'Invalid file type. Use jpg, jpeg, or png'}), 400
        
        # Save file temporarily
        filename = secure_filename(file.filename)
        filepath = os.path.join(UPLOAD_FOLDER, filename)
        file.save(filepath)
        
        # Preprocess and predict
        img_array = preprocess_image(filepath)
        predictions = model.predict(img_array, verbose=0)
        score = predictions[0]
        
        # Get top prediction
        predicted_index = np.argmax(score)
        predicted_breed = class_names[predicted_index]
        confidence = float(score[predicted_index])
        
        # Get top 5 predictions
        top_5_indices = np.argsort(score)[-5:][::-1]
        top_5_predictions = [
            {
                'breed': class_names[i],
                'confidence': float(score[i])
            }
            for i in top_5_indices
        ]
        
        # Clean up temp file
        os.remove(filepath)
        
        return jsonify({
            'success': True,
            'breed': predicted_breed,
            'confidence': confidence,
            'confidence_percentage': f"{confidence * 100:.2f}%",
            'top_5_predictions': top_5_predictions
        })
    
    except Exception as e:
        # Clean up temp file if it exists
        if 'filepath' in locals() and os.path.exists(filepath):
            os.remove(filepath)
        
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500


@app.route('/identify-base64', methods=['POST'])
def identify_breed_base64():
    """
    Alternative endpoint that accepts base64 encoded images
    Useful for direct image data transfer
    """
    try:
        data = request.get_json()
        
        if 'image' not in data:
            return jsonify({'error': 'No image data provided'}), 400
        
        # Decode base64 image
        image_data = base64.b64decode(data['image'].split(',')[1] if ',' in data['image'] else data['image'])
        img = Image.open(BytesIO(image_data))
        
        # Save temporarily
        temp_path = os.path.join(UPLOAD_FOLDER, 'temp_base64.jpg')
        img.save(temp_path)
        
        # Preprocess and predict
        img_array = preprocess_image(temp_path)
        predictions = model.predict(img_array, verbose=0)
        score = predictions[0]
        
        predicted_index = np.argmax(score)
        predicted_breed = class_names[predicted_index]
        confidence = float(score[predicted_index])
        
        # Get top 5 predictions
        top_5_indices = np.argsort(score)[-5:][::-1]
        top_5_predictions = [
            {
                'breed': class_names[i],
                'confidence': float(score[i])
            }
            for i in top_5_indices
        ]
        
        # Clean up
        os.remove(temp_path)
        
        return jsonify({
            'success': True,
            'breed': predicted_breed,
            'confidence': confidence,
            'confidence_percentage': f"{confidence * 100:.2f}%",
            'top_5_predictions': top_5_predictions
        })
    
    except Exception as e:
        # Clean up temp file if it exists
        if 'temp_path' in locals() and os.path.exists(temp_path):
            os.remove(temp_path)
        
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500


if __name__ == '__main__':
    print("\n" + "="*50)
    print("🐕 Dog Breed Identification API")
    print("="*50)
    print(f"📊 Loaded model with {len(class_names)} breeds")
    print("🚀 Starting Flask server on http://localhost:5001")
    print("\nEndpoints:")
    print("  GET  /health              - Health check")
    print("  POST /identify            - Identify breed from image file")
    print("  POST /identify-base64     - Identify breed from base64 image")
    print("\n" + "="*50 + "\n")
    
    app.run(debug=True, host='0.0.0.0', port=5001)
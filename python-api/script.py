import tensorflow as tf
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.applications import MobileNetV2
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Dense, GlobalAveragePooling2D, Dropout
from tensorflow.keras.optimizers import Adam
import os
import splitfolders

# --- CONFIGURATION ---
# The folder containing all your dog breed subfolders (e.g., 'n02116738-African_hunting_dog')
SOURCE_DATA_DIR = 'E:/Downloads/Capstone/For ComfyUI/images/dog-breeds'
# The new folder that will contain 'train' and 'val' subfolders
OUTPUT_DATA_DIR = 'dog_dataset_split'
IMAGE_SIZE = (224, 224)
BATCH_SIZE = 32
LEARNING_RATE = 0.0001
EPOCHS = 15 # Increased slightly from 10, may need tuning
MODEL_FILENAME = 'dog_breed_classifier.keras'
# ---------------------

print("--- 1. Starting Data Split ---")

# Check if the split has already been done to prevent re-running
if not os.path.isdir(OUTPUT_DATA_DIR):
    print(f"Splitting data from {SOURCE_DATA_DIR} into {OUTPUT_DATA_DIR}...")
    splitfolders.ratio(
        SOURCE_DATA_DIR,
        output=OUTPUT_DATA_DIR,
        seed=42,
        ratio=(0.8, 0.2), # 80% Training, 20% Validation
        group_prefix=None,
        move=False
    )
    print("Data split complete. Directory structure created.")
else:
    print(f"Data split directory '{OUTPUT_DATA_DIR}' already exists. Skipping split.")

print("\n--- 2. Setting Up Data Generators ---")

# Data Augmentation and Preprocessing
train_datagen = ImageDataGenerator(
    rescale=1./255,
    rotation_range=20,
    width_shift_range=0.2,
    height_shift_range=0.2,
    shear_range=0.2,
    zoom_range=0.2,
    horizontal_flip=True,
    fill_mode='nearest'
)

validation_datagen = ImageDataGenerator(rescale=1./255) # Only rescaling for validation

train_generator = train_datagen.flow_from_directory(
    os.path.join(OUTPUT_DATA_DIR, 'train'),
    target_size=IMAGE_SIZE,
    batch_size=BATCH_SIZE,
    class_mode='categorical'
)

validation_generator = validation_datagen.flow_from_directory(
    os.path.join(OUTPUT_DATA_DIR, 'val'), # 'val' is the default folder name from splitfolders
    target_size=IMAGE_SIZE,
    batch_size=BATCH_SIZE,
    class_mode='categorical'
)

num_classes = train_generator.num_classes
print(f"✅ Number of dog breeds found: {num_classes}")

print("\n--- 3. Building MobileNetV2 Transfer Learning Model ---")

# 1. Load the pre-trained MobileNetV2 base model
base_model = MobileNetV2(
    input_shape=IMAGE_SIZE + (3,),
    include_top=False,
    weights='imagenet'
)

# 2. Freeze the base model layers
base_model.trainable = False

# 3. Create the new custom classification head
model = Sequential([
    base_model,
    GlobalAveragePooling2D(),
    Dropout(0.3),  # Increased dropout for better regularization
    Dense(512, activation='relu'),
    Dropout(0.3),
    Dense(num_classes, activation='softmax') # Final classification layer
])

# 4. Compile the model
model.compile(
    optimizer=Adam(learning_rate=LEARNING_RATE),
    loss='categorical_crossentropy',
    metrics=['accuracy']
)

model.summary()

print("\n--- 4. Training the Model ---")
history = model.fit(
    train_generator,
    steps_per_epoch=train_generator.samples // BATCH_SIZE,
    epochs=EPOCHS,
    validation_data=validation_generator,
    validation_steps=validation_generator.samples // BATCH_SIZE
)

# 5. Save the entire model
model.save(MODEL_FILENAME)
print(f"\nModel successfully saved as: {MODEL_FILENAME}")

# IMPORTANT: Save the class names for prediction later
class_names = list(train_generator.class_indices.keys())
with open('class_names.txt', 'w') as f:
    for item in class_names:
        f.write(f"{item}\n")
print("Class names saved to 'class_names.txt'.")


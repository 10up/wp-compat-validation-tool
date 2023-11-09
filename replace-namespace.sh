#!/bin/bash

# Script directory and filename
SCRIPT_DIR="$(dirname "$0")"
SCRIPT_NAME="$(basename "$0")"

# Check for the required argument
if [ "$#" -ne 1 ]; then
	echo "Usage: $0 New_Namespace"
	exit 1
fi

NEW_NAMESPACE="$1"

# Use find to get all files recursively from the script's directory, excluding the script itself
find "$SCRIPT_DIR" -type f \( -name "*.php" -o -name "*.json" \) ! -name "$SCRIPT_NAME" | while read -r file; do
	echo $file
	# Use perl for the replacement in each file
	perl -pi -e "s/WP_Compat_Validation_Tool/$NEW_NAMESPACE/g" "$file"
done

cd 10up-lib/wp-compat-validation-tool && rm -rf .git .github .gitignore composer.json composer.lock CHANGELOG.md CONTRIBUTING.md README.md LICENSE.md CODE_OF_CONDUCT.md CREDITS.md

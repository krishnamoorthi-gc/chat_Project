# Chatbot Data Loading & Storage Roadmap

This roadmap outlines the backend development steps to build the knowledge base system for your chatbot.

## Phase 1: Database & Data Structure
**Goal**: Create the persistent storage for chatbots and their raw knowledge sources.

1.  **Create `Chatbot` Model**
    -   Represents a single bot instance.
    -   fields: `id`, `user_id`, `name`, `prompt_template`, `settings` (json).
2.  **Create `KnowledgeSource` Model**
    -   Represents a file, text block, or URL.
    -   fields: `id`, `chatbot_id`, `type` (file/text/url), `title`, `content` (for raw text), `file_path`, `status` (pending/processed/failed).
3.  **Create `ContextData` / `Embedding` Model**
    -   Represents the processed "chunks" of data used for AI answers.
    -   fields: `id`, `source_id`, `content_chunk`, `token_count`, `vector` (if using local pgvector) or `external_id`.

## Phase 2: File Upload & Processing
**Goal**: specific handling for PDF, Excel, and Text inputs.
1.  **File Upload System**
    -   Install `maatwebsite/excel` for spreadsheets.
    -   Install text extraction tools (e.g., `spatie/pdf-to-text`).
    -   Build a `KnowledgeController` to handle file uploads via Dropzone (already in UI design).
2.  **Text Extraction Service**
    -   Create a service class `TextExtractor` that takes a file path and returns clean text string.
3.  **Data Chunking**
    -   Implement a utility to split large text into smaller chunks (e.g., 500-1000 tokens) with overlap.

## Phase 3: Vector Embeddings (The "Brain")
**Goal**: Convert text to numbers (vectors) that the AI can understand and search.
1.  **Select Embedding Provider**
    -   Option A: OpenAI Embeddings API (Easiest, paid).
    -   Option B: Local Python service (Free, complex).
    -   *Recommendation: Start with OpenAI.*
2.  **Vector Database Setup**
    -   Option A: **pgvector** (PostgreSQL extension) - Keeps everything in one DB.
    -   Option B: **Qdrant** / **Pinecone** - External vector databases.
    -   *Recommendation: pgvector (if using Postgres) or a simple JSON/Local approach for MVP.*
3.  **Processing Job**
    -   Create a Laravel Job `ProcessKnowledgeSource`.
    -   Workflow: `Extract Text` -> `Chunk Text` -> `Get Embeddings` -> `Store Vectors`.

## Phase 4: Chat Logic & Retrieval (RAG)
**Goal**: Answer questions using the stored knowledge.
1.  **Retrieval System**
    -   When user asks a query -> Convert query to embedding.
    -   Search database for "nearest neighbor" chunks.
2.  **LLM Integration**
    -   Construct prompt: "Use the following context to answer the user request..." + [Retrieved Chunks].
    -   Send to LLM (e.g., GPT-3.5/4).
3.  **Testing Endpoint**
    -   API endpoint that takes `chatbot_id` and `message`, returns `answer`.

## Phase 5: UI Connection
**Goal**: Connect the beautiful dashboard you built to these real backend functions.
1.  **Knowledge Base Page**
    -   List active sources.
    -   Show processing status (Loading spinners).
    -   Delete/Edit sources.
2.  **Chat Playground**
    -   Connect the "Test Bot" chat window to the backend API.

---

## Suggested Next Step
**Start with Phase 1: Database Migrations.**
Shall I create the migration files for `Chatbot` and `KnowledgeSource` now?

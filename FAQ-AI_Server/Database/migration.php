<?php

require_once __DIR__ . '/../V1/config.php';

$faqs = [
    [
        "question" => "What is the o1 model?",
        "answer" => "The o1 model is a Large Language Model (LLM) developed by OpenAI that uses advanced reasoning patterns like Chain-of-Thought (CoT) to solve complex problems."
    ],
    [
        "question" => "What are Test-time Compute methods?",
        "answer" => "Test-time Compute methods are techniques that help models think more effectively before responding, improving their performance in tasks like coding, math, and reasoning."
    ],
    [
        "question" => "What are the key areas tested in this study?",
        "answer" => "The study tested the models in three key areas: commonsense reasoning, coding, and math."
    ],
    [
        "question" => "What makes the o1 model stand out?",
        "answer" => "The o1 model outperforms other models by using reasoning patterns like Divide and Conquer, Self-Refinement, and Method Reuse, which help it solve multi-step problems more effectively."
    ],
    [
        "question" => "How does the o1 model perform on AIME (math)?",
        "answer" => "The o1 model scored 62% on AIME, significantly outperforming GPT-4o, which scored 12.22%."
    ],
    [
        "question" => "What was the o1 model's performance on USACO (coding)?",
        "answer" => "The o1 model scored 44.6% on USACO, beating GPT-4o."
    ],
    [
        "question" => "How does the o1 model compare to GPT-4o?",
        "answer" => "The o1 model outperforms GPT-4o in both math (AIME) and coding (USACO) tasks."
    ],
    [
        "question" => "What is the Best-of-N (BoN) method, and how does it perform?",
        "answer" => "BoN improves accuracy up to N=8 but levels off due to limitations in the reward model."
    ],
    [
        "question" => "What is Step-wise BoN, and what are its challenges?",
        "answer" => "Step-wise BoN works well for simple tasks but struggles with complex problems due to long-context challenges, generating too many intermediate tokens."
    ],
    [
        "question" => "How does Agent Workflow compare to the o1 model?",
        "answer" => "Agent Workflow is the closest competitor to o1, breaking tasks into smaller steps using domain-specific prompts."
    ],
    [
        "question" => "What is Self-Refine, and what are its limitations?",
        "answer" => "Self-Refine helps slightly but struggles with keeping answers in the right format due to recursion loops."
    ],
    [
        "question" => "What is Divide and Conquer (DC) in the o1 model?",
        "answer" => "DC is a reasoning pattern where the model breaks down big problems into smaller, manageable steps."
    ],
    [
        "question" => "How does Self-Refinement (SR) work in the o1 model?",
        "answer" => "SR allows the model to adjust and improve answers while solving problems, correcting mistakes during inference."
    ],
    [
        "question" => "What is Method Reuse (MR) in the o1 model?",
        "answer" => "MR involves reusing known solutions or strategies for similar problems, speeding up reasoning."
    ],
    [
        "question" => "What is Systematic Analysis (SA) in the o1 model?",
        "answer" => "SA involves planning ahead and organizing problem-solving steps to reduce errors."
    ],
    [
        "question" => "What is Context Identification (CI) in the o1 model?",
        "answer" => "CI helps the model extract the most relevant information from multiple sources to form accurate answers."
    ],
    [
        "question" => "What is Emphasizing Constraints (EC) in the o1 model?",
        "answer" => "EC ensures that the model's responses adhere to specific output requirements, such as word limits or formatting rules."
    ],
    [
        "question" => "Which reasoning patterns are most useful for math and coding tasks?",
        "answer" => "Method Reuse (MR) and Divide and Conquer (DC) are particularly useful for math and coding tasks."
    ],
    [
        "question" => "Which reasoning patterns are most useful for commonsense reasoning?",
        "answer" => "Context Identification (CI) and Emphasizing Constraints (EC) are most useful for commonsense reasoning tasks."
    ],
    [
        "question" => "What are the challenges with Step-wise BoN?",
        "answer" => "Step-wise BoN generates too many intermediate tokens (up to 450 tokens), making it difficult for models to handle long contexts."
    ],
    [
        "question" => "What is the bottleneck for Best-of-N (BoN) methods?",
        "answer" => "The reward model is a bottleneck for BoN methods, as human intervention improved HotpotQA accuracy by 33%."
    ],
    [
        "question" => "What are the limitations of Self-Refine?",
        "answer" => "Self-Refine struggles with keeping answers in the right format due to recursion loops."
    ],
    [
        "question" => "What are the challenges in handling long contexts?",
        "answer" => "Long-context challenges arise when models generate too many intermediate tokens, making it difficult to manage and process information effectively."
    ],
    [
        "question" => "What benchmarks were used in the study?",
        "answer" => "The study used HotpotQA for commonsense reasoning, USACO for coding, and AIME for math."
    ],
    [
        "question" => "What baselines were used for comparison?",
        "answer" => "The baselines included o1-preview, o1-mini, o1-web, GPT-4o, and other methods like BoN, Step-wise BoN, Self-Refine, and Agent Workflow."
    ],
    [
        "question" => "How was accuracy measured in the study?",
        "answer" => "Accuracy was measured through rule-based evaluation (HotpotQA/AIME) and test cases (USACO)."
    ],
    [
        "question" => "How does the o1 model perform on HotpotQA?",
        "answer" => "The o1 model summarizes documents and splits complex questions into smaller ones, correctly identifying answers like \"Ghostbusters Spooktacular\" as the replaced Universal Studios attraction."
    ],
    [
        "question" => "How does the o1 model handle AIME problems?",
        "answer" => "The o1 model uses well-known math formulas to solve AIME problems faster, achieving a 62% score."
    ],
    [
        "question" => "How does the o1 model solve USACO coding problems?",
        "answer" => "The o1 model uses \"Break It Down\" and \"Fix as You Go\" to solve coding problems step by step, generating working code successfully."
    ],
    [
        "question" => "How does the o1 model handle constrained generation in Collie?",
        "answer" => "The o1 model ensures word count and formatting rules are met, producing correct outputs without breaking constraints."
    ],
    [
        "question" => "What improvements are suggested for future LLM architectures?",
        "answer" => "Future LLMs should incorporate Divide and Conquer (DC) and Self-Refinement (SR) for better multi-step reasoning and work on improving reward models."
    ],
    [
        "question" => "What is the future of benchmarking in LLMs?",
        "answer" => "The report suggests curating more challenging datasets, like filtered HotpotQA, to better evaluate reasoning capabilities."
    ],
    [
        "question" => "How can inference optimization be improved?",
        "answer" => "Inference optimization can be improved by fixing long-context issues in Step-wise BoN with better token management."
    ],
    [
        "question" => "What is the key takeaway from the o1 model's success?",
        "answer" => "The o1 model's success shows that reasoning patterns like Divide and Conquer and Self-Refinement are key to solving tough problems, and future LLMs should focus on improving these patterns."
    ]
];

try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("INSERT INTO faqs (question, answer) VALUES (?, ?)");

    foreach ($faqs as $faq) {
        $stmt->execute([$faq["question"], $faq["answer"]]);
    }

    echo "FAQ data imported successfully.\\n";

} catch (PDOException $e) {
    die("Database connection failed or import error: " . $e->getMessage());
}

?>